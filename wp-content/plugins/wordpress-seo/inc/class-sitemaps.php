<?php

class WPSEO_Sitemaps {
	/**
	 * Content of the sitemap to output.
	 */
	private $sitemap = '';

	/**
	 * XSL stylesheet for styling a sitemap for web browsers
	 */
	private $stylesheet = '';

	/**
	 * Flag to indicate if this is an invalid or empty sitemap.
	 */
	private $bad_sitemap = false;

	function __construct() {
		$options = get_option('wpseo_xml');
		if ( !isset($options['enablexmlsitemap']) || !$options['enablexmlsitemap'] )
			return;

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'template_redirect', array( $this, 'redirect' ) );
		add_filter( 'redirect_canonical', array( $this, 'canonical' ) );
		add_action( 'transition_post_status', array( $this, 'status_transition' ), 10, 3 );
		add_action( 'admin_init', array( $this, 'delete_sitemaps' ) );
		add_action( 'wpseo_hit_sitemap_index', array( $this, 'hit_sitemap_index' ) );

		// default stylesheet
		$this->stylesheet = '<?xml-stylesheet type="text/xsl" href="'.WPSEO_FRONT_URL.'css/xml-sitemap.xsl"?>';
	}

	/**
	 * Register your own sitemap. Call this during 'init'.
	 *
	 * @param string $name The name of the sitemap
	 * @param callback $function Function to build your sitemap
	 * @param string $rewrite Optional. Regular expression to match your sitemap with
	 */
	function register_sitemap( $name, $function, $rewrite = '' ) {
		add_action( 'wpseo_do_sitemap_' . $name, $function );
		if ( ! empty( $rewrite ) )
			add_rewrite_rule( $rewrite, 'index.php?sitemap=' . $name, 'top' );
	}

	/**
	 * Set the sitemap content to display after you have generated it.
	 *
	 * @param string $sitemap The generated sitemap to output
	 */
	function set_sitemap( $sitemap ) {
		$this->sitemap = $sitemap;
	}

	/**
	 * Set a custom stylesheet for this sitemap. Set to empty to just remove
	 * the default stylesheet.
	 *
	 * @param string $stylesheet Full xml-stylesheet declaration
	 */
	function set_stylesheet( $stylesheet ) {
		$this->stylesheet = $stylesheet;
	}

	/**
	 * Set as true to make the request 404. Used stop the display of empty sitemaps or
	 * invalid requests.
	 *
	 * @param bool $bool Is this a bad request. True or false.
	 */
	function set_bad_sitemap( $bool ) {
		$this->bad_sitemap = (bool) $bool;
	}

	/**
	 * Initialize sitemaps. Add sitemap rewrite rules and query var
	 */
	function init() {
		$GLOBALS['wp']->add_query_var( 'sitemap' );
		$GLOBALS['wp']->add_query_var( 'sitemap_n' );
		add_rewrite_rule( 'sitemap_index\.xml$', 'index.php?sitemap=1', 'top' );
		add_rewrite_rule( '([^/]+?)-sitemap([0-9]+)?\.xml$', 'index.php?sitemap=$matches[1]&sitemap_n=$matches[2]', 'top' );
	}

	/**
	 * Hijack requests for potential sitemaps.
	 */
	function redirect() {
		$type = get_query_var( 'sitemap' );
		if ( empty( $type ) )
			return;

		$this->build_sitemap( $type );
		// 404 for invalid or emtpy sitemaps
		if ( $this->bad_sitemap ) {
			$GLOBALS['wp_query']->is_404 = true;
			return;
		}

		$this->output();
		die();
	}

	/**
	 * Attempt to build the requested sitemap. Sets $bad_sitemap if this isn't
	 * for the root sitemap, a post type or taxonomy.
	 *
	 * @param string $type The requested sitemap's identifier.
	 */
	function build_sitemap( $type ) {
		$type = apply_filters('wpseo_build_sitemap_post_type', $type);

		if ( $type == 1 )
			$this->build_root_map();
		else if ( post_type_exists( $type ) )
			$this->build_post_type_map( $type );
		else if ( $tax = get_taxonomy( $type ) )
			$this->build_tax_map( $tax );
		else if ( has_action( 'wpseo_do_sitemap_' . $type ) )
			do_action( 'wpseo_do_sitemap_' . $type );
		else
			$this->bad_sitemap = true;
	}

	/**
	 * Build the root sitemap -- example.com/sitemap_index.xml -- which lists sub-sitemaps
	 * for other content types.
	 *
	 * @todo lastmod for sitemaps?
	 */

	function build_root_map() {
		global $wpdb;

		$options = get_wpseo_options();

		$this->sitemap = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
		$base = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '';

		// reference post type specific sitemaps
		foreach ( get_post_types( array('public' => true) ) as $post_type ) {
			if ( in_array( $post_type, array('revision','nav_menu_item','attachment') ) )
				continue;
				
			if ( isset($options['post_types-'.$post_type.'-not_in_sitemap']) && $options['post_types-'.$post_type.'-not_in_sitemap'] )
				continue;

			$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = %s AND post_status = 'publish' LIMIT 1", $post_type ) );
			// don't include post types with no posts
			if ( ! $count )
				continue;

			$n = ($count > 1000) ? (int) ceil($count / 1000) : 1;
			for ( $i = 0; $i < $n; $i++ ) {
				$count = ($n > 1) ? $i + 1 : '';

				if ( empty($count) || $count == $n ) {
					$date = $this->get_last_modified( $post_type );
				} else {
					$date = $wpdb->get_var( $wpdb->prepare( "SELECT post_modified_gmt FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = %s ORDER BY post_modified_gmt ASC LIMIT 1 OFFSET %d", $post_type, $i * 1000 + 999 ) );
					$date = date( 'c', strtotime( $date ) );
				}

				$this->sitemap .= '<sitemap>' . "\n";
				$this->sitemap .= '<loc>' . home_url( $base . $post_type . '-sitemap' . $count . '.xml' ) . '</loc>' . "\n";
				$this->sitemap .= '<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . "\n";
				$this->sitemap .= '</sitemap>' . "\n";
			}
		}

		// reference taxonomy specific sitemaps
		foreach ( get_taxonomies( array('public' => true) ) as $tax ) {
			if ( in_array( $tax, array('link_category', 'nav_menu', 'post_format') ) )
				continue;
				
			if ( isset($options['taxonomies-'.$tax.'-not_in_sitemap']) && $options['taxonomies-'.$tax.'-not_in_sitemap'] )
				continue;
			// don't include taxonomies with no terms
			if ( ! $wpdb->get_var( $wpdb->prepare( "SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy = %s AND count != 0 LIMIT 1", $tax ) ) )
				continue;
			
			// Retrieve the post_types that are registered to this taxonomy and then retrieve last modified date for all of those combined.
			$taxobj = get_taxonomy( $tax );
			$date = $this->get_last_modified( $taxobj->object_type );
			
			$this->sitemap .= '<sitemap>' . "\n";
			$this->sitemap .= '<loc>' . home_url( $base . $tax . '-sitemap.xml' ) . '</loc>' . "\n";
			$this->sitemap .= '<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . "\n";
			$this->sitemap .= '</sitemap>' . "\n";
		}

		// allow other plugins to add their sitemaps to the index
		$this->sitemap .= apply_filters( 'wpseo_sitemap_index', '' );
		$this->sitemap .= '</sitemapindex>';
	
	}

	/**
	 * Build a sub-sitemap for a specific post type -- example.com/post_type-sitemap.xml
	 *
	 * @param string $post_type Registered post type's slug
	 */
	function build_post_type_map( $post_type ) {
		$options = get_wpseo_options();
		
		if ( 
			( isset($options['post_types-'.$post_type.'-not_in_sitemap']) && $options['post_types-'.$post_type.'-not_in_sitemap'] ) 
		 	|| in_array( $post_type, array('revision','nav_menu_item','attachment') ) 
			) {
			$this->bad_sitemap = true;
			return;
		}
		
		$output = '';

		$front_id = get_option('page_on_front');
		if ( $front_id && $post_type == 'page' ) {
			$output .= $this->sitemap_url( array(
				'loc' => home_url('/'),
				'pri' => 1,
				'chf' => 'daily',
			) );
		} else if ( ! $front_id && ( $post_type == 'post' || $post_type == 'page' ) ) {
			$output .= $this->sitemap_url( array(
				'loc' => home_url('/'),
				'pri' => 1,
				'chf' => 'daily',
			) );
		}

		if ( function_exists('get_post_type_archive_link') ) {
			$archive = get_post_type_archive_link( $post_type );
			if ( $archive ) {
				$output .= $this->sitemap_url( array(
					'loc' => $archive,
					'pri' => 0.8,
					'chf' => 'weekly',
					'mod' => $this->get_last_modified( $post_type ) // get_lastpostmodified( 'gmt', $post_type ) #17455
				) );
			}
		}

		global $wpdb;
		
		$join_filter = '';
		$join_filter = apply_filters('wpseo_typecount_join', $join_filter, $post_type);
		$where_filter = '';
		$where_filter = apply_filters('wpseo_typecount_where', $where_filter, $post_type);
		$typecount = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts {$join_filter} WHERE post_status = 'publish' AND post_password = '' AND post_type = '$post_type' {$where_filter}");
		
		if ( $typecount == 0 && empty( $archive ) ) {
			$this->bad_sitemap = true;
			return;
		}

		// Let's flush the object cache so we're not left with garbage from other plugins
		wp_cache_flush();
		
		$stackedurls = array();

		$steps = 25;
		$n = (int) get_query_var( 'sitemap_n' );
		$offset = ($n > 1) ? ($n - 1) * 1000 : 0;
		$total = $offset + 1000;
		if ( $total > $typecount )
			$total = $typecount;

		// We grab post_date, post_name, post_author and post_status too so we can throw these objects into get_permalink, which saves a get_post call for each permalink.
		while( $total > $offset ) {
			
			$join_filter = '';
			$join_filter = apply_filters('wpseo_posts_join', $join_filter, $post_type);
			$where_filter = '';
			$where_filter = apply_filters('wpseo_posts_where', $where_filter, $post_type);
			
			$posts = $wpdb->get_results("SELECT ID, post_content, post_name, post_author, post_parent, post_modified_gmt, post_date, post_date_gmt
			FROM $wpdb->posts {$join_filter}
			WHERE post_status = 'publish'
			AND	post_password = ''
			AND post_type = '$post_type'
			{$where_filter}
			ORDER BY post_modified ASC
			LIMIT $steps OFFSET $offset");
			
			$offset = $offset + $steps;

			foreach ( $posts as $p ) {
				$p->post_type 	= $post_type;
				$p->post_status = 'publish';
				$p->filter		= 'sample';
				
				if ( $p->ID == $front_id )
					continue;

				if ( wpseo_get_value('meta-robots-noindex', $p->ID) && wpseo_get_value('sitemap-include', $p->ID) != 'always' )
					continue;
				if ( wpseo_get_value('sitemap-include', $p->ID) == 'never' )
					continue;
				if ( wpseo_get_value('redirect', $p->ID) && strlen( wpseo_get_value('redirect', $p->ID) ) > 0 )
					continue;

				$url = array();

				$url['mod']	= ( isset( $p->post_modified_gmt ) && $p->post_modified_gmt != '0000-00-00 00:00:00' ) ? $p->post_modified_gmt : $p->post_date_gmt ;
				$url['chf'] = 'weekly';
				$url['loc'] = get_permalink( $p );

				$canonical = wpseo_get_value('canonical', $p->ID);
				if ( $canonical && $canonical != '' && $canonical != $url['loc']) {
					// Let's assume that if a canonical is set for this page and it's different from the URL of this post, that page is either
					// already in the XML sitemap OR is on an external site, either way, we shouldn't include it here.
					continue;
				} else {

					if ( isset($options['trailingslash']) && $options['trailingslash'] && $p->post_type != 'post' )
						$url['loc'] = trailingslashit( $url['loc'] );
				}

				$pri = wpseo_get_value('sitemap-prio', $p->ID);
				if (is_numeric($pri))
					$url['pri'] = $pri;
				elseif ($p->post_parent == 0 && $p->post_type == 'page')
					$url['pri'] = 0.8;
				else
					$url['pri'] = 0.6;

				$url['images'] = array();
				if ( preg_match_all( '/<img [^>]+>/', $p->post_content, $matches ) ) {
					foreach ( $matches[0] as $img ) {
						// FIXME: get true caption instead of alt / title
						if ( preg_match( '/src=("|\')([^"|\']+)("|\')/', $img, $match ) ) {
							$src = $match[2];
							if ( strpos($src, 'http') !== 0 ) {
								if ( $src[0] != '/' )
									continue;
								$src = get_bloginfo('url') . $src;
							}

							if ( $src != esc_url( $src ) )
								continue;

							if ( isset( $url['images'][$src] ) )
								continue;

							$image = array();
							if ( preg_match( '/title=("|\')([^"\']+)("|\')/', $img, $match ) )
								$image['title'] = str_replace( array('-','_'), ' ', $match[2] );

							if ( preg_match( '/alt=("|\')([^"\']+)("|\')/', $img, $match ) )
								$image['alt'] = str_replace( array('-','_'), ' ', $match[2] );

							$url['images'][$src] = $image;
						}
					}
				}
				if ( preg_match_all( '/\[gallery/', $p->post_content, $matches ) ) {
					$attachments = get_children( array('post_parent' => $p->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );
					foreach( $attachments as $att_id => $attachment ) {
						$src = wp_get_attachment_image_src( $att_id, 'large', false );
						$src = $src[0];
						$image = array();

						if ( $alt = get_post_meta( $att_id, '_wp_attachment_image_alt', true) )
							$image['alt'] = $alt;
						
						$image['title'] = $attachment->post_title;

						$url['images'][$src] = $image;
					}
				}

				$url['images'] = apply_filters( 'wpseo_sitemap_urlimages', $url['images'], $p->ID );

				if ( !in_array( $url['loc'], $stackedurls ) ) {
					$output .= $this->sitemap_url( $url );
					$stackedurls[] = $url['loc'];
				}

				// Clear the post_meta and the term cache for the post, as we no longer need it now.
				wp_cache_delete( $p->ID, 'post_meta' );
				// clean_object_term_cache( $p->ID, $post_type );
			}
		}

		if ( empty( $output ) ) {
			$this->bad_sitemap = true;
			return;
		}

		$this->sitemap = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" ';
		$this->sitemap .= 'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" ';
		$this->sitemap .= 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
		$this->sitemap .= $output . '</urlset>';
	}

	/**
	 * Build a sub-sitemap for a specific taxonomy -- example.com/tax-sitemap.xml
	 *
	 * @param string $taxonomy Registered taxonomy's slug
	 */
	function build_tax_map( $taxonomy ) {
		$options = get_wpseo_options();
		if ( 
			( isset($options['taxonomies-'.$taxonomy->name.'-not_in_sitemap']) && $options['taxonomies-'.$taxonomy->name.'-not_in_sitemap'] )
			|| in_array( $taxonomy, array('link_category', 'nav_menu', 'post_format') )
			) {
			$this->bad_sitemap = true;
			return;
		}

		$terms = get_terms( $taxonomy->name, array('hide_empty' => true) );

		global $wpdb;
		$output = '';
		foreach( $terms as $c ) {
			$url = array();

			if ( wpseo_get_term_meta( $c, $c->taxonomy, 'noindex' )
				&& wpseo_get_term_meta( $c, $c->taxonomy, 'sitemap_include' ) != 'always' )
				continue;

			if ( wpseo_get_term_meta( $c, $c->taxonomy, 'sitemap_include' ) == 'never' )
				continue;

			$url['loc'] = wpseo_get_term_meta( $c, $c->taxonomy, 'canonical' );
			if ( !$url['loc'] ) {
				$url['loc'] = get_term_link( $c, $c->taxonomy );
				if ( isset($options['trailingslash']) && $options['trailingslash'] )
					$url['loc'] = trailingslashit($url['loc']);
			}
			if ($c->count > 10) {
				$url['pri'] = 0.6;
			} else if ($c->count > 3) {
				$url['pri'] = 0.4;
			} else {
				$url['pri'] = 0.2;
			}

			// Grab last modified date
			$sql = "SELECT MAX(p.post_date) AS lastmod
					FROM	$wpdb->posts AS p
					INNER JOIN $wpdb->term_relationships AS term_rel
					ON		term_rel.object_id = p.ID
					INNER JOIN $wpdb->term_taxonomy AS term_tax
					ON		term_tax.term_taxonomy_id = term_rel.term_taxonomy_id
					AND		term_tax.taxonomy = '$c->taxonomy'
					AND		term_tax.term_id = $c->term_id
					WHERE	p.post_status = 'publish'
					AND		p.post_password = ''";
			$url['mod'] = $wpdb->get_var( $sql );
			$url['chf'] = 'weekly';
			$output .= $this->sitemap_url( $url );
		}

		if ( empty( $output ) ) {
			$this->bad_sitemap = true;
			return;
		}

		$this->sitemap = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
		$this->sitemap .= 'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" ';
		$this->sitemap .= 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
		$this->sitemap .= $output . '</urlset>';
	}

	/**
	 * Spit out the generated sitemap and relevant headers and encoding information.
	 */
	function output() {
		// Prevent the search engines from indexing the XML Sitemap.
		header( 'X-Robots-Tag: noindex, follow', true );
		
		header( 'Content-Type: text/xml' );
		echo '<?xml version="1.0" encoding="'.get_bloginfo('charset').'"?>';
		if ( $this->stylesheet )
			echo apply_filters('wpseo_stylesheet_url', $this->stylesheet) . "\n";
		echo $this->sitemap;
		echo "\n" . '<!-- XML Sitemap generated by Yoast WordPress SEO -->';

		if ( WP_DEBUG )
			echo "\n" . '<!-- Built in ' . timer_stop() . ' seconds | ' . memory_get_peak_usage() . ' | ' . count($GLOBALS['wpdb']->queries) . ' -->';
	}

	/**
	 * Build the <url> tag for a given URL.
	 *
	 * @param array $url Array of parts that make up this entry
	 */
	function sitemap_url( $url ) {
		if ( isset($url['mod']) )
			$date = mysql2date( "Y-m-d\TH:i:s+00:00", $url['mod'] );
		else
			$date = date('c');
		$output = "\t<url>\n";
		$output .= "\t\t<loc>".$url['loc']."</loc>\n";
		$output .= "\t\t<lastmod>".$date."</lastmod>\n";
		$output .= "\t\t<changefreq>".$url['chf']."</changefreq>\n";
		$output .= "\t\t<priority>".str_replace(',','.',$url['pri'])."</priority>\n";
		if ( isset($url['images']) && count($url['images']) > 0 ) {
			foreach( $url['images'] as $src => $img ) {
				$output .= "\t\t<image:image>\n";
				$output .= "\t\t\t<image:loc>".htmlspecialchars( $src )."</image:loc>\n";
				if ( isset($img['title']) )
					$output .= "\t\t\t<image:title>".htmlspecialchars( $img['title'] )."</image:title>\n";
				if ( isset($img['alt']) )
					$output .= "\t\t\t<image:caption>".htmlspecialchars( $img['alt'] )."</image:caption>\n";
				$output .= "\t\t</image:image>\n";
			}
		}
		$output .= "\t</url>\n";
		return $output;
	}

	/**
	 * Notify search engines of the updated sitemap.
	 */
	function ping_search_engines() {
		$options = get_wpseo_options();
		$base = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '';
		$sitemapurl = urlencode( home_url( $base . 'sitemap_index.xml' ) );

		// Always ping Google and Bing, optionally ping Ask and Yahoo!
		wp_remote_get('http://www.google.com/webmasters/tools/ping?sitemap='.$sitemapurl);
		wp_remote_get('http://www.bing.com/webmaster/ping.aspx?sitemap='.$sitemapurl);
		
		if ( isset($options['xml_ping_yahoo']) && $options['xml_ping_yahoo'] )
				wp_remote_get('http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=3usdTDLV34HbjQpIBuzMM1UkECFl5KDN7fogidABihmHBfqaebDuZk1vpLDR64I-&url='.$sitemapurl);

		if ( isset($options['xml_ping_ask']) && $options['xml_ping_ask'] )
			wp_remote_get('http://submissions.ask.com/ping?sitemap='.$sitemapurl);
	}

	/**
	 * Hooked into transition_post_status. Will initiate search engine pings
	 * if the post is being published, is a post type that a sitemap is built for
	 * and is a post that is included in sitemaps.
	 *
	 * @todo Potentially schedule a cron event instead so that pinging runs in the background.
	 */
	function status_transition( $new_status, $old_status, $post ) {
		if ( $new_status != 'publish' )
			return;
	
		wp_cache_delete( 'lastpostmodified:gmt:' . $post->post_type, 'timeinfo' ); // #17455

		$options = get_wpseo_options();
		if ( isset($options['post_types-'.$post->post_type.'-not_in_sitemap']) && $options['post_types-'.$post->post_type.'-not_in_sitemap'] )
			return;

		if ( WP_CACHE )
			wp_schedule_single_event( time(), 'wpseo_hit_sitemap_index' );

		if ( wpseo_get_value( 'sitemap-include', $post->ID ) != 'never' )
			$this->ping_search_engines();
	}

	/**
	 * Make a request for the sitemap index so as to cache it before the arrival of the search engines.
	 */
	function hit_sitemap_index() {
		$base = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '';
		$url = home_url( $base . 'sitemap_index.xml' );
		wp_remote_get( $url );
	}

	/**
	 * Hook into redirect_canonical to stop trailing slashes on sitemap.xml URLs
	 */
	function canonical( $redirect ) {
		$sitemap = get_query_var( 'sitemap' );
		if ( ! empty( $sitemap ) )
			return false;

		return $redirect;
	}

	/**
	 * Remove sitemaps residing on disk as they will block our rewrite.
	 */
	function delete_sitemaps() {
		$options = get_option( 'wpseo' );
		if ( isset($options['enablexmlsitemap']) && $options['enablexmlsitemap'] ) {
			$file = ABSPATH . 'sitemap_index.xml';
			if ( ( ! isset($options['blocking_files']) || ! is_array( $options['blocking_files'] ) || ! in_array( $file, $options['blocking_files'] ) ) &&
				file_exists( $file )
			) {
				if ( ! is_array( $options['blocking_files'] ) )
					$options['blocking_files'] = array();
				$options['blocking_files'][] = $file;
				update_option( 'wpseo', $options );
			}
		}
	}

	function get_last_modified( $post_types ) {
		global $wpdb;
		if ( ! is_array($post_types) )
			$post_types = array( $post_types );

		$result = 0;
		foreach ( $post_types as $post_type ) {
			$key = 'lastpostmodified:gmt:' . $post_type;
			$date = wp_cache_get( $key, 'timeinfo' );
			if ( ! $date ) {
				$date = $wpdb->get_var( $wpdb->prepare( "SELECT post_modified_gmt FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = %s ORDER BY post_modified_gmt DESC LIMIT 1", $post_type ) );
				if ( $date )
					wp_cache_set( $key, $date, 'timeinfo' );
			}
			if ( strtotime($date) > $result )
				$result = strtotime($date);
		}

		// Transform to W3C Date format.
		$result = date( 'c', $result );
		return $result;
	}
}

$wpseo_sitemaps = new WPSEO_Sitemaps();
