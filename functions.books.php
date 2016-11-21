<?php
define( 'THEME_URI'      , get_stylesheet_directory_uri() );

//添加导航
if (function_exists('register_nav_menus')) {
	register_nav_menus( array(
		'header-menu' => __('顶部菜单') )
		);
}

//移除菜单的多余CSS选择器
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var){
	return is_array($var) ? array() : '';
}

// 标题判断
function title() {
	if(is_home()){
		bloginfo('name'); echo " - "; bloginfo('description');
	}elseif (is_category()) {
		single_cat_title(); echo " - "; bloginfo('name');
	}elseif (is_single() || is_page()) {
		foreach ( (get_the_category()) as $category) {
			echo $category->cat_name; echo " "; single_post_title(); echo " - "; bloginfo('name');
		}
	}elseif (is_search()) {
		echo "搜索结果"; echo " - "; bloginfo('name');
	}elseif (is_404()) {
		echo "页面未找到"; echo " - "; bloginfo('name');
	}else{
		wp_title('', true);
	}
}

// WordPress Emoji Delete
remove_action( 'admin_print_scripts' ,  'print_emoji_detection_script');
remove_action( 'admin_print_styles'  ,  'print_emoji_styles');
remove_action( 'wp_head'             ,  'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles'     ,  'print_emoji_styles');
remove_filter( 'the_content_feed'    ,  'wp_staticize_emoji');
remove_filter( 'comment_text_rss'    ,  'wp_staticize_emoji');
remove_filter( 'wp_mail'             ,  'wp_staticize_emoji_for_email');


// 
// delete google fonts
// ====================================================
//
// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
endif;

// 文章字数统计
function count_words ($text) {
	global $post;
	if ( '' == $text ) {
	   $text = $post->post_content;
	   if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '本章字数：' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') ;
	   return $output;
	}
}

// 底部边栏
register_sidebar(
	array(
		'name' =>__('底部边栏'),
		'id' => 'widget_footer',
		'description' => __('底部边栏'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
		)
	);

//404页面
function wpbooks_404(){
    echo '<div class="e404"><img src="'.THEME_URI.'/images/404.png"><h1>404 . Not Found</h1><p>沒有找到你要的内容！</p><br><p><a href="'.get_bloginfo('url').'">返回首页</a></p></div>';
}