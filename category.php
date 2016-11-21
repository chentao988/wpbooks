<?php get_header(); ?>
<article class="category">
	<div class="cat-info">
		<div class="cat-info-img">
			<img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>" alt="<?php single_cat_title();?>" />
		</div>
		<div class="cat-info-info">
			<h1><?php single_cat_title(); ?></h1>
			<?php echo category_description($category);?>
		</div>
	</div>
<?php if (get_option('cat_middle_ad') == 'checked' ) 
{
	echo '<div class="cat_middle_ad">'.get_option('cat_middle').'</div>';
}
?>
<ul class="cat-ul">
<?php $args = array (
	// 'offset' => '1',  不显示第一篇文章
	'orderby' => 'post_date',
	'order' => 'ASC',
	'cat' => "'<?php $cat = single_cat_title('', false); echo get_cat_ID($cat);?>'"
);
	query_posts($args);
	$count = 0;
	if (have_posts()) : while (have_posts()) : the_post();
	$count++;
	if ($count <= 3)
	 { 
?>
	<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo wp_trim_words(get_the_title(),18); ?></a></li>
	<?php }
		if ($count == 3) { $count = 0 ;}
	endwhile; 
		wp_reset_query();
		if($count == 1) { 
			echo "<li><a>&nbsp;</a></li><li><a>&nbsp;</a></li>"; 
		}elseif($count == 2) {
			echo "<li><a>&nbsp;&nbsp;</a></li>";}
		// }elseif($count == 3) {
		// 	echo "<li><a>&nbsp;</a></li>";
		// }
	endif; 
	?>
</ul>
</article>
<?php get_footer(); ?>