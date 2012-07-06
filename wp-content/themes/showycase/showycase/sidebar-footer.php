<?php
// Check if any of the areas have widgets
	if (   ! is_active_sidebar( 'sidebar-4'  )
		&& ! is_active_sidebar( 'sidebar-5' )
		&& ! is_active_sidebar( 'sidebar-6'  )
	)
		return;
// If we get this far, we have widgets. Let do this.
?>
<section id="footer-wid" <?php premi_footer_sidebar_class(); ?>>
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="footer-first" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #footer_first .widget_area -->
		<?php endif; ?>
	
		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
		<div id="footer-second" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-5' ); ?>
		</div><!-- #footer_second .widget_area -->
		<?php endif; ?>
	
		<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
		<div id="footer-third" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</div><!-- #footer_third .widget_area -->
		<?php endif; ?>
		
		<div class="clear"></div>
</section><!-- footerWid -->