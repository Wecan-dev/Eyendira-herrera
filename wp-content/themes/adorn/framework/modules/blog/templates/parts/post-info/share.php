<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if(adorn_edge_core_plugin_installed() && adorn_edge_options()->getOptionValue('enable_social_share') === 'yes' && adorn_edge_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="edge-blog-share">
        <?php echo adorn_edge_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>