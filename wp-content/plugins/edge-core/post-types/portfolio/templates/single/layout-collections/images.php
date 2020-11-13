<div class="edge-ps-content-holder">
    <div class="edge-ps-title-holder">
        <?php edge_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
    </div>
    <div class="edge-ps-info-holder">
        <?php
        //get portfolio custom fields section
        edge_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);

        //get portfolio date section
        edge_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);

        //get portfolio tags section
        edge_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
        ?>
    </div>
</div>
<div class="edge-ps-image-holder">
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
<div class="edge-ps-social-info-holder">
    <?php
    //get portfolio share section
    edge_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
    ?>
</div>