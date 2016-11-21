<?php get_header(); ?>
<!-- <script>
	document.onkeydown = chang_page; 
		function chang_page(e) { 
		var e = e || event, 
		keycode = e.which || e.keyCode; 
		if (keycode == 39 || keycode == 34) 
		location = "<?php echo get_permalink(get_adjacent_post(false, '', false)); ?>"; 
		if (keycode == 37 || keycode == 33) 
		location = "<?php echo get_permalink(get_adjacent_post(false, '', true)); ?>"; 
	}
</script> -->
<div class="content">
	<div class="content_margin">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<h1><?php single_post_title();?></h1>
		<span class="content_author">作者：<?php the_author(); ?></span>
		<span class="content_size"><?php echo count_words ($text); ?></span>
		<span class="content_date">发布时间：<?php the_date('Y-m-d'); ?></span>
		<div class="read"><?php the_content(); ?></div>
		<div class="link">
<?php
	$categories = get_the_category();
	$categoryIDS = array();
	foreach ($categories as $category) {
		array_push($categoryIDS, $category->term_id);
	}
	$categoryIDS = implode(",", $categoryIDS);
	if (get_previous_post($categoryIDS)) {
		previous_post_link("%link","上一章",true);
	}else{
		$category = get_the_category();
		if ($category[0]) {
			echo '<a href="'.get_category_link($category[0]->term_id).'">上一章</a>';
		};
	};
?>
<?php
	$category = get_the_category();
	if ($category[0]) {
		echo '<a href="'.get_category_link($category[0]->term_id).'" title="'.$category[0]->cat_name.'" >返回目录</a>';
	};
?>
<?php
	if (get_next_post($categoryIDS)) {
		next_post_link("%link","下一章",true);
	}else{
		$category = get_the_category();
		if ($category[0]) {
			echo '<a href="'.get_category_link($category[0]->term_id).'">下一章</a>';
		};
	};
?>
		</div>
		<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer();?>