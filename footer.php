<footer>
<?php if(is_home()){
	echo "<div class='footer_link'>友情链接:";
	if (function_exists(wpjam_blogroll)) wpjam_blogroll();
	echo "</div>";
}
?>
	<div class="footer_cr">
	<p>Copyright © 2016 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
	<p><?php echo get_option( 'zh_cn_l10n_icp_num' );?></p>
	<p><?php if (get_option('tongji') == 'checked' ) 
	{
		echo get_option('tongji_code');
	}
	?></p>
	<?php echo $index_domain;?>
	</div>
</footer>
</body>
</html>