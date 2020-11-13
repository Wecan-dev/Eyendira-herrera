<?php
$gallery_classes = '';
$number_of_columns = adorn_edge_get_meta_field_intersect('portfolio_single_gallery_columns_number');
if(!empty($number_of_columns)) {
	$gallery_classes .= ' edge-ps-'.$number_of_columns.'-columns';
}
$space_between_items = adorn_edge_get_meta_field_intersect('portfolio_single_gallery_space_between_items');
if(!empty($space_between_items)) {
	$gallery_classes .= ' edge-ps-'.$space_between_items.'-space';
}
?>
<div class="edge-grid-row">
	<div class="edge-grid-col-8">
		<div class="edge-ps-image-holder edge-ps-gallery-images <?php echo esc_attr($gallery_classes); ?>">
			<div class="edge-ps-image-inner">
				<?php
				$media = edge_core_get_portfolio_single_media();
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="edge-ps-image">
							<?php edge_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="edge-grid-col-4">
		<div class="edge-ps-info-holder">
			<?php
			//get portfolio content section
			edge_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
			
			//get portfolio custom fields section
			edge_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio date section
			edge_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			edge_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			
			//get portfolio share section
			edge_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>