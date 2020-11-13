<?php $i = 0; ?>
<div class="edge-frame-slider-holder">
	<div class="edge-fs-phone"></div>
	<div class="edge-fs-slides">
		<?php foreach ($images as $image) { ?>
			<div class="edge-fs-slide">
				<?php if(!empty($links)){ ?>
					<a class="edge-ig-link" href="<?php echo esc_url($links[$i++]) ?>" title="<?php echo esc_attr($image['alt']); ?>" target="<?php echo esc_attr($target); ?>">
				<?php } ?>
					<?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
				<?php if(!empty($links)){ ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
