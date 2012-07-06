		<div class="clear"></div>
	</section><!-- #content-wrap -->
	
	<footer id="ending">
		<?php get_sidebar('footer'); ?>
		
		<div id="copyright">
			<?php if( of_get_option('footer_note') ): echo of_get_option('footer_note'); else: ?>
			&copy; 2011, Premium WordPress theme by <a href="http://premitheme.com">premitheme</a>. Sold exclusively on <a href="http://themeforest.net/user/premitheme/portfolio?WT.ac=item_portfolio&WT.seg_1=item_portfolio&WT.z_author=premitheme&ref=premitheme">ThemeForest.net</a>
			<?php endif; ?>
		</div>
	</footer><!-- #ending -->
	
	<div class="clear"></div>
</div>

<!-- WP FOOTER -->
<?php wp_footer();?>
</body>
</html>