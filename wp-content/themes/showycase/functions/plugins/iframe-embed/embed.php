<?php
/*
Plugin Name: DirtySuds - Embed YouTube
Plugin URI: http://blog.dirtysuds.com/category/plugins/embed-youtube-iframe/
Description: Embed YouTube videos using iFrame player instead of Flash <object>
Author: Dirty Suds
Version: 1.06
Author URI: http://dirtysuds.com

Updates:
1.06 - Fixed problem with Youtu.be URLs (Thanks Uzicoppa)
1.05 - Enable auto-embeds on activation
1.04 - Added support for wmode=transparent
1.03 - Clear oembed cache on install
1.02 - Added check to see if embeds work properly
1.01 - Bugfix
1.00.20110224 - First Version

  Copyright 2011 Pat Hawks  (email : pat@pathawks.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function dirtysuds_embed_youtube_iframe($oembed_providers) {
	$oembed_providers['#http://(www\.)?youtube.com/watch.*#i'] = array('http://www.youtube.com/oembed?iframe=1',true);
	$oembed_providers['http://youtu.be/*'] = array('http://www.youtube.com/oembed?iframe=1',false);
	return $oembed_providers;
}

function dirtysuds_embed_youtube_iframe_enable_embeds() {
	update_option('embed_autourls',1);
}

function dirtysuds_embed_youtube_iframe_cache(){
	// Based on delete_post_meta_by_key()
	global $wpdb;
	$post_ids = $wpdb->get_col( "SELECT DISTINCT post_id FROM $wpdb->postmeta WHERE meta_key LIKE '_oembed_%'" );
	if ( $post_ids ) {
		$postmetaids = $wpdb->get_col( "SELECT meta_id FROM $wpdb->postmeta WHERE meta_key LIKE '_oembed_%'" );
		$in = implode( ',', array_fill( 1, count($postmetaids), '%d' ) ); 
		do_action( 'delete_postmeta', $postmetaids );
		$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_id IN($in)", $postmetaids ) ); 
		do_action( 'deleted_postmeta', $postmetaids );
		foreach ( $post_ids as $post_id )
			wp_cache_delete( $post_id, 'post_meta' );
	}
}



function dirtysuds_embed_youtube_iframe_rate($links,$file) {
		if (plugin_basename(__FILE__) == $file) {
			$links[] = '<a href="http://wordpress.org/extend/plugins/dirtysuds-embed-youtube-iframe/">Rate this plugin</a>';
		}
	return $links;
}

function dirtysuds_embed_youtube_iframe_allow_transparancy($embed) {
	if (strstr($embed,'http://www.youtube.com/embed/')) {
		return str_replace('?fs=1','?fs=1&wmode=transparent',$embed);
	} else {
		return $embed;
	}
}

add_action( 'after_setup_theme', 'dirtysuds_embed_youtube_iframe_enable_embeds' );
add_action( 'after_setup_theme', 'dirtysuds_embed_youtube_iframe_cache' );
//register_activation_hook( __FILE__, 'dirtysuds_embed_youtube_iframe_enable_embeds' );
//register_activation_hook( __FILE__, 'dirtysuds_embed_youtube_iframe_cache' );
//register_uninstall_hook( __FILE__, 'dirtysuds_embed_youtube_iframe_cache' );
add_filter('oembed_providers', 'dirtysuds_embed_youtube_iframe', 1, true);
add_filter('oembed_result', 'dirtysuds_embed_youtube_iframe_allow_transparancy', 1, true);
add_filter('plugin_row_meta', 'dirtysuds_embed_youtube_iframe_rate',10,2);