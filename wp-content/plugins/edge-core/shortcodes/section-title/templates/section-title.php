<div class="edge-section-title-holder" <?php echo adorn_edge_get_inline_style($holder_styles); ?>>
	<?php if(!empty($title)) { ?>

		<<?php echo esc_attr($title_tag); ?> class="edge-st-title" <?php echo adorn_edge_get_inline_style($title_styles); ?>>
            <?php
                if($link !== ''){?>
                    <a href="<?php echo esc_url($link);?>" target="_blank">
            <?php }?>

			<span>
                <?php echo esc_html($title); ?>
            </span>

            <?php  if($link !== ''){?>
                    </a>
		    <?php }?>

		</<?php echo esc_attr($title_tag); ?>>

	<?php }

	if(!empty($text)) { ?>
		<p class="edge-st-text" <?php echo adorn_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	<?php } ?>

</div>