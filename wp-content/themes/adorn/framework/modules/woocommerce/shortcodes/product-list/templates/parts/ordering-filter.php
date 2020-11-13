<?php if($show_ordering_filter == 'yes'){ ?>
<div class="edge-pl-ordering-outer">
    <h6><?php esc_html_e('Filter','adorn'); ?></h6>
    <div class="edge-pl-ordering">
        <div>
            <h5><?php esc_html_e('Sort By','adorn'); ?></h5>
            <ul>
                <?php echo adorn_edge_get_module_part($ordering_filter_list); ?>
            </ul>
        </div>
        <div>
            <h5><?php esc_html_e('Price Range','adorn'); ?></h5>
            <ul class="edge-pl-ordering-price">
                <?php echo adorn_edge_get_module_part($pricing_filter_list); ?>
            </ul>
        </div>
    </div>
</div>
<?php }