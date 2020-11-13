<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
$edge_sidebar_layout  = adorn_edge_sidebar_layout();

get_header();
adorn_edge_get_title();
get_template_part('slider');
?>
<div class="edge-full-width">
	<div class="edge-full-width-inner">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="edge-grid-row">
				<div <?php echo adorn_edge_get_content_sidebar_class(); ?>>
					<?php
					the_content();
					do_action('adorn_edge_page_after_content');
					?>
				</div>
				<?php if($edge_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo adorn_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>
<?php get_footer(); ?>