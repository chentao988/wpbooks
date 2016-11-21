<?php get_header(); ?>
<?php if (get_option('index_top_ad') == 'checked' ) 
{
	echo '<div class="index_top_ad">'.get_option('index_top').'</div>';
}
?>
<article class="htmleaf-container">
	<div class="wrapper">
		<ul class="gallery">
			<?php
				$categories = get_categories('order=DESC&exclude=0');
				foreach ($categories as $cat) {
					$catid = $cat->cat_ID;
					query_posts("cat=$catid");
			?>
			<li>
				<a href="<?php echo get_category_link($catid);?>" data-tooltip="<?php single_cat_title(); ?>"><img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>" /></a>
			</li>
			<?php wp_reset_query(); }; ?>
		</ul>
	</div>
</article>
<?php if (get_option('index_footer_ad') == 'checked' ) 
{
	echo '<div class="index_footer_ad">'.get_option('index_footer').'</div>';
}
?>
<?php get_footer(); ?>