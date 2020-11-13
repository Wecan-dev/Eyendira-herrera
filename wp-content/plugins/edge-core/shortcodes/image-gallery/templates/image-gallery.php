<?php $i = 0; ?>

<div class="edge-image-gallery">
	<div class="edge-ig-grid <?php echo esc_attr($gallery_classes); ?>">
        <?php $rand = rand(0,1000); ?>
		<?php foreach ($images as $image) { ?>
			<div class="edge-ig-image">
                <div class="edge-ig-image-inner">
                    <?php if ($pretty_photo) { ?>
                        <a itemprop="image" class="edge-ig-lightbox" href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">

                    <?php } else if($image['link']){ ?>

                        <a itemprop="url" class="edge-ig-link" href="<?php echo esc_url($image['link']) ?>" title="<?php echo esc_attr($image['title']); ?>" target="<?php echo esc_attr($custom_link_target); ?>">

                            <?php } ?>


                        <?php if(is_array($image_size) && count($image_size)) : ?>
                            <?php echo adorn_edge_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
                        <?php endif; ?>

                    <?php if ($grayscale !== 'yes'): ?>
                        <span class="edge-image-gallery-hover"></span>
                    <?php endif; ?>
                    <?php if ($pretty_photo || $image['link'] !== '') { ?>
                        </a>
                    <?php } ?>
                </div>
			</div>
		<?php } ?>
	</div>
</div>