<?php
    $description = '';
    $keywords = '';
    if (is_home()) {  //首页
        $description = "唐家三少作品集";
        $keywords = "唐家三少作品集简介";
    }elseif (is_single()) {   //文章页
        $description1 = get_post_meta($post->ID,"description",true);
        $description2 = str_replace("\n", "", mb_strimwidth(strip_tags($post->post_content), 0, 200, "...", "utf-8"));
        //填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
        $description = $description1 ? $description1 : $description2;
        //自定义关键字
        $keywords = get_post_meta($post->ID, "keywords", true);
        if ($keywords == '') {
          $keywords = single_post_title('', false);
        }
    }elseif (is_category()) {  //分类description可以到后台 - 文章 - 标签，修改标签的描述
        $description = str_replace("\n", "", category_description());
        $keywords = single_tag_title('', false).'最新章节,'.single_tag_title('', false).'目录';

    }elseif (is_tag()) {  //tag的description可以到后台 - 文章 - 标签，修改标签的描述
        $description = str_replace(tag_description());
        $keywords = single_tag_title('', false);
    }
    $description = trim(strip_tags($description));
    $keywords = trim(strip_tags($keywords));
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <title><?php title(); ?></title>
    <meta name="description" content="<?php echo $description; ?>" />   
    <meta name="keywords" content="<?php echo $keywords; ?>" />

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/pgwmenu.css" />

    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pgwmenu.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $('.pgwMenu').pgwMenu({
            dropDownLabel: '菜单',
            viewMoreLabel: '更多<span class="icon"></span>'
        });
    });
    </script>
    <?php wp_head(); ?>
</head>
<body>
<header class="main-header">
    <div class="main-title"><?php
    if(is_single()){
        foreach((get_the_category()) as $category) { echo $category->cat_name; };
    }else{
        bloginfo('name');
    }
    ?></div>
</header>
<nav>
    <?php wp_nav_menu( array(
        'container_class' => '',
        'container_id' => '',
        'menu_class' => 'pgwMenu',
    ) );?>
</nav>