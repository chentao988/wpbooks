<?php
//友情链接工具
add_action('admin_init', 'wpjam_blogroll_settings_api_init');
function wpjam_blogroll_settings_api_init() {
	add_settings_field('wpjam_blogroll_setting', '友情链接', 'wpjam_blogroll_setting_callback_function', 'reading');
	register_setting('reading','wpjam_blogroll_setting');
}
function wpjam_blogroll_setting_callback_function() {
	echo '<textarea name="wpjam_blogroll_setting" rows="10" cols="50" id="wpjam_blogroll_setting" class="large-text code">' . get_option('wpjam_blogroll_setting') . '</textarea>';
}
function wpjam_blogroll(){
	$wpjam_blogroll_setting =  get_option('wpjam_blogroll_setting');
	if($wpjam_blogroll_setting){
		$wpjam_blogrolls = explode("\n", $wpjam_blogroll_setting);
		foreach ($wpjam_blogrolls as $wpjam_blogroll) {
			$wpjam_blogroll = explode("|", $wpjam_blogroll );
			echo ' <a href="'.trim($wpjam_blogroll[0]).'" title="'.esc_attr(trim($wpjam_blogroll[1])).'">'.trim($wpjam_blogroll[1]).'</a> ';
        }
    }
}

//后台主题设置
function themeoptions_admin_menu(){
	//在控制面板的侧边栏添加设置选项页链接
	add_theme_page("主题设置", "主题设置", 'edit_themes', basename(__FILE__), 'themeoptions_page');
}

if ( $_POST['update_themeoptions'] == 'true') {
	themeoptions_update();
}

function themeoptions_update(){
	update_option('tongji_code', $_POST['tongji_code']);
	if ($_POST['tongji'] == 'on'){ $display = 'checked';}else{ $display = ''; }
	update_option('tongji', $display);

	update_option('index_top', $_POST['index_top']);
	if ($_POST['index_top_ad'] == 'on'){ $display = 'checked';}else{ $display = ''; }
	update_option('index_top_ad', $display);

	update_option('index_footer', $_POST['index_footer']);
	if ($_POST['index_footer_ad'] == 'on'){ $display = 'checked';}else{ $display = ''; }
	update_option('index_footer_ad', $display);

	update_option('cat_middle', $_POST['cat_middle']);
	if ($_POST['cat_middle_ad'] == 'on'){ $display = 'checked';}else{ $display = ''; }
	update_option('cat_middle_ad', $display);
}

function themeoptions_page(){
	//设置选项页面的主要功能
	echo '
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br /></div>
		<h2>主题设置</h2>
		<form method="POST" action="">
		<input type="hidden" name="update_themeoptions" value="true" />
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><input type="checkbox" name="tongji" id="tongji" '.get_option('tongji').' />统计代码</th>
					<td><textarea name="tongji_code" rows="10" id="tongji_code" class="large-text code">'.get_option('tongji_code').'</textarea></td>
				</tr>
				<tr>
					<th scope="row"><input type="checkbox" name="index_top_ad" id="index_top_ad" '.get_option('index_top_ad').' />首页顶部</th>
					<td><textarea name="index_top" rows="10" id="index_top" class="large-text code">'.get_option('index_top').'</textarea></td>
				</tr>
				<tr>
					<th scope="row"><input type="checkbox" name="index_footer_ad" id="index_footer_ad" '.get_option('index_footer_ad').' />首页底部</th>
					<td><textarea name="index_footer" rows="10" id="index_footer" class="large-text code">'.get_option('index_footer').'</textarea></td>
				</tr>
				<tr>
					<th scope="row"><input type="checkbox" name="cat_middle_ad" id="cat_middle_ad" '.get_option('cat_middle_ad').' />目录中部</th>
					<td><textarea name="cat_middle" rows="10" id="cat_middle" class="large-text code">'.get_option('cat_middle').'</textarea></td>
				</tr>
			</tbody>
		</table>
		<p><input type="submit" name="submit" id="submit" class="button button-primary" value="保存"></p>
		</form>
	</div>
	';
}
add_action('admin_menu', 'themeoptions_admin_menu');