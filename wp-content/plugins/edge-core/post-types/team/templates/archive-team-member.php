<?php
get_header();
adorn_edge_get_title(); ?>
<div class="edge-container edge-default-page-template">
	<?php do_action('adorn_edge_after_container_open'); ?>
	<div class="edge-container-inner clearfix">
		<?php
			$edge_taxonomy_id = get_queried_object_id();
			$edge_taxonomy = !empty($edge_taxonomy_id) ? get_category($edge_taxonomy_id) : '';
			$edge_taxonomy_slug = !empty($edge_taxonomy) ? $edge_taxonomy->slug : '';
		
			edge_core_get_team_category_list($edge_taxonomy_slug);
		?>
	</div>
	<?php do_action('adorn_edge_before_container_close'); ?>
</div>
<?php get_footer(); ?>
