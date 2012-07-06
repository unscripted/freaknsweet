<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
	<?php if( is_sticky() ): ?>
	<div class="sticky-badge" title="Sticky Post"></div>
	<?php endif; ?>
	
	<div class="header-entry-meta">
		<span><span>&middot;</span><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time();; ?>"><?php echo get_the_date(); ?></a></span>
	</div>
	
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 40); ?>
	</div>
	
	<div class="entry-content">
		<?php the_content(); ?>
		
		<?php if ( is_single() ): ?>
		<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
		
		<?php if( of_get_option('sharing_on') == '' || of_get_option('sharing_on') != '0' ): ?>
		<?php get_template_part('inc/sharing_btns'); ?>
		<?php endif; ?>
		
		<?php endif; ?>
	</div>
	
	<div class="clear"></div>
	
	<div class="footer-entry-meta">
		<?php echo get_the_tag_list( '<span class="tags-list">', '', '</span>' ); ?>
		
		<?php if( !is_single() ) comments_popup_link( __( '0', 'premitheme' ), __( '1', 'premitheme' ), '%', 'comments-link', __( '--', 'premitheme' ) ); ?>
		
		<div class="clear"></div>
	</div>
</article>