<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="edge-blockquote-shortcode" <?php adorn_edge_get_inline_style($blockquote_style); ?> >
	<h5 class="edge-blockquote-text">
        <span>&#8220;</span><span><?php echo esc_attr($text); ?></span><span>&#8221;</span>
	</h5>
    <span class="edge-blockquote-author">
        <?php echo esc_attr($author); ?>
    </span>
</blockquote>