<?php
/*
Template Name: About Us Page
*/
?>
<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
				<?php if ( has_post_thumbnail()): ?>
				<div class="entry-thumb">
					<?php the_post_thumbnail('fullwidth-page-image'); ?>
				</div>
				<?php endif; ?>
				
				<h1 class="entry-title"><?php the_title(); ?></h1>
				
				<div class="entry-content">
					<?php the_content(); ?>
					
					<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
					
					<div class="footer-entry-meta">
					<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
				
				
				<?php
				if( of_get_option('show_team') == '' || of_get_option('show_team') != '0' ):
				
				// SHOW TEAM MEMBARS IF HAVE ANY
				global $post;
				$tmp_post = $post;
				$myposts = get_posts('numberposts=-1&order=DESC&orderby=post_date&post_type=team');
				if( !empty($myposts) ): ?>
				
				<div id="work-team">
					<h2 id="team-title"><?php if( of_get_option('team_label') ) echo of_get_option('team_label'); else _e('Recent Work', 'premitheme'); ?></h2>
					<ul>
						<?php foreach( $myposts as $post ) : setup_postdata($post);
						
						$memberRole = get_post_meta($post->ID, 'memberRole', TRUE);
						$memberBio = get_post_meta($post->ID, 'memberBio', TRUE);
						$memberTwitter = get_post_meta($post->ID, 'memberTwitter', TRUE);
						$memberWeb = get_post_meta($post->ID, 'memberWeb', TRUE);
						$memberPhoto = get_post_meta($post->ID, 'memberImgURL', TRUE);
						$memberPhotoUrl = vt_resize( '', $memberPhoto, 159, 180, true );
						
						?>
						
						<li <?php post_class('team-member-wrap');?>>
							<div class="team-member-photo"><?php echo '<img title="'.get_the_title().'" src="'.$memberPhotoUrl['url'].'" width="'.$memberPhotoUrl['width'].'" height="'.$memberPhotoUrl['height'].'" alt=""/>'; ?></div>
							<h2 class="team-member-name"><?php the_title(); ?></h2>
							<h3 class="team-member-role"><?php echo $memberRole; ?></h3>
							<div class="team-member-bio">
								<p><?php echo $memberBio; ?></p>
							</div>
							<ul class="team-member-links">
								<?php if($memberTwitter){ ?><li class="team-member-twitter"><a href="<?php echo $memberTwitter; ?>">Follow me</a></li><?php } ?>
								<?php if($memberWeb){ ?><li class="team-member-web"><span>&middot;</span><a href="<?php echo $memberWeb; ?>">Visit website</a></li><?php } ?>
							</ul>
						</li>
						
						<?php endforeach; ?>
						<?php $post = $tmp_post;
						wp_reset_query(); ?>
						<li class="clear"></li>
					</ul><!-- .recent-posts -->
				</div>
				<?php endif; endif;?>
			</article>
			
		</div><!-- #main -->
		
<?php get_footer();?>