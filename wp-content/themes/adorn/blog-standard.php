<?php
    /*
        Template Name: Blog: Standard
    */
?>
<?php
$edge_blog_type = 'standard';
adorn_edge_include_blog_helper_functions('lists', $edge_blog_type);
$edge_holder_params = adorn_edge_get_holder_params_blog();
?>
<?php get_header(); ?>
<?php adorn_edge_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="<?php echo esc_attr($edge_holder_params['holder']); ?>">
        <?php do_action('adorn_edge_after_container_open'); ?>
        <div class="<?php echo esc_attr($edge_holder_params['inner']); ?>">
	        <?php if (have_posts()) : while (have_posts()) : the_post();
		        adorn_edge_get_blog($edge_blog_type);
	        endwhile; endif; ?>
        </div>
        <?php do_action('adorn_edge_before_container_close'); ?>
    </div>
<?php do_action('adorn_edge_blog_list_additional_tags'); ?>
<?php get_footer(); ?>