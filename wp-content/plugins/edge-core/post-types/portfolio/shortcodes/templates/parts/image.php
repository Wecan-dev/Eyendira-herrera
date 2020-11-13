<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="edge-pli-image">
	<?php if(has_post_thumbnail()) { ?>
		<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_size); ?>
	<?php } else { ?>
		<img itemprop="image" class="edge-pl-original-image" width="800" height="600" src="<?php echo EDGE_ASSETS_ROOT.'/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Portfolio Featured Image', 'edge-core'); ?>" />
	<?php } ?>
</div>