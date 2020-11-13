<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$edge_sidebar_layout  = adorn_edge_sidebar_layout();

get_header();
adorn_edge_get_title();
get_template_part('slider');

//Woocommerce content
if ( ! is_singular('product') ) { ?>
	<div class="edge-container">
		<div class="edge-container-inner clearfix">
			<div class="edge-grid-row">
				<div <?php echo adorn_edge_get_content_sidebar_class(); ?>>
					<?php adorn_edge_woocommerce_content(); ?>
				</div>
				<?php if($edge_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo adorn_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="edge-container">
		<div class="edge-container-inner clearfix">
			<?php adorn_edge_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>