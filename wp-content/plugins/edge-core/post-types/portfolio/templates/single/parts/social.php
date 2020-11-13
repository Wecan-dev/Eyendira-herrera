<div class="edge-portfolio-single-likes">
    <?php echo adorn_edge_like_portfolio_single(); ?>
</div>
<?php if(adorn_edge_core_plugin_installed() && adorn_edge_options()->getOptionValue('enable_social_share') == 'yes' && adorn_edge_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="edge-ps-info-item edge-ps-social-share">
        <?php echo adorn_edge_get_social_share_html() ?>
    </div>
<?php endif; ?>