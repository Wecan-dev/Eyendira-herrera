<?php
$edge_blog_type = adorn_edge_get_archive_blog_list_layout();
adorn_edge_include_blog_helper_functions('lists', $edge_blog_type);
$edge_holder_params = adorn_edge_get_holder_params_blog();
?>
<?php get_header(); ?>
<?php adorn_edge_get_title(); ?>
	<div class="<?php echo esc_attr($edge_holder_params['holder']); ?>">
		<?php do_action('adorn_edge_after_container_open'); ?>
		<div class="<?php echo esc_attr($edge_holder_params['inner']); ?>">
			<?php adorn_edge_get_blog($edge_blog_type); ?>
		</div>
		<?php do_action('adorn_edge_before_container_close'); ?>
	</div>
<?php do_action('adorn_edge_blog_list_additional_tags'); ?>
<?php get_footer(); ?>