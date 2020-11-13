<?php if($max_num_pages > 1) { ?>
	<div class="edge-blog-pag-loading">
		<div class="edge-blog-pag-bounce1"></div>
		<div class="edge-blog-pag-bounce2"></div>
		<div class="edge-blog-pag-bounce3"></div>
	</div>
	<div class="edge-blog-pag-load-more">
		<?php
        if(adorn_edge_core_plugin_installed()) {
			echo adorn_edge_get_button_html(
                apply_filters(
                    'adorn_edge_blog_template_load_more_button',
                    array(
                        'link' => 'javascript: void(0)',
                        'size' => 'large',
                        'text' => esc_html__('Load more', 'adorn')
			        )
                )
            );
        } else { ?>
            <a itemprop="url" href="javascript:void(0)" target="_self" class="edge-btn edge-btn-large edge-btn-solid">
                <span class="edge-btn-text">
                    <?php echo esc_html__('Load more', 'adorn'); ?>
                </span>
            </a>
		<?php } ?>
	</div>
	<?php
	$unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'edgtf_blog_load_more_nonce_' . $unique_id, 'edgtf_blog_load_more_nonce_' . $unique_id );
}