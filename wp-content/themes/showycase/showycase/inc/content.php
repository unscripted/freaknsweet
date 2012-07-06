<?php

$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$titleAtt = sprintf( __('View all posts by %s', 'premitheme'), $author );

?>
<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
	<?php if ( has_post_thumbnail()): ?>
	<div class="entry-thumb">
	<?php if( is_single() ): ?>
		<?php the_post_thumbnail('blog-standard-thumb'); ?>
	<?php else:
	$titleAtt = sprintf( __('Permalink to %s', 'premitheme'), get_the_title() ); ?>
	<a class="blog-overlay" href="<?php the_permalink(); ?>" title="<?php echo $titleAtt; ?>">
		<?php the_post_thumbnail('blog-standard-thumb'); ?>
		
		<span class="more-hover"></span>
	</a>
	<?php endif; ?>
	</div>
	<?php endif; ?>
	
	<?php if( is_sticky() ): ?>
	<div class="sticky-badge" title="Sticky Post"></div>
	<?php endif; ?>
	
	<?php if( is_single() ): ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php else: ?>
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php endif; ?>
	
	<div class="header-entry-meta">
		<span><span>&middot;</span><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_time();; ?>"><?php echo get_the_date(); ?></a></span>
		
		<span><span>&middot;</span><?php echo get_the_category_list( __(', ', 'premitheme') );?></span>
		
		<?php if( is_single() ): ?>
		<span><span>&middot;</span><?php printf( __('By %s', 'premitheme'), '<a href="'. $author_url .'" title="'. $titleAtt .'">'. $author .'</a>' );?></span>
		<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link"><span>&middot;</span>', '</span>' ); ?>
		<?php endif; ?>
	</div>
	
	<div class="entry-content">
		<?php if( is_single() ): ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
		
		<?php if( of_get_option('sharing_on') == '' || of_get_option('sharing_on') != '0' ): ?>
		<?php get_template_part('inc/sharing_btns'); ?>
		<?php endif; ?>
		
		<?php else: ?>
		<?php the_excerpt(); ?>
		<?php endif; ?>
	</div>
	
	<div class="footer-entry-meta">
		<?php echo get_the_tag_list( '<span class="tags-list">', '', '</span>' ); ?>
		
		<?php if( !is_single() ) comments_popup_link( __( '0', 'premitheme' ), __( '1', 'premitheme' ), '%', 'comments-link', __( '--', 'premitheme' ) ); ?>
		
		<div class="clear"></div>
	</div>
</article>