<?php do_action('adorn_edge_before_sticky_header'); ?>

<div class="edge-sticky-header">
    <?php do_action( 'adorn_edge_after_sticky_menu_html_open' ); ?>
    <div class="edge-sticky-holder">
    <?php if($sticky_header_in_grid) : ?>
        <div class="edge-grid">
            <?php endif; ?>
            <div class=" edge-vertical-align-containers">
                <div class="edge-position-left">
                    <div class="edge-position-left-inner">
                        <?php if(!$hide_logo) {
                            adorn_edge_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <?php if($menu_area_position == 'center') { ?>
                    <div class="edge-position-center">
                        <div class="edge-position-center-inner">
                            <?php adorn_edge_get_sticky_menu('edge-sticky-nav');; ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="edge-position-right">
                    <div class="edge-position-right-inner">
                        <?php if($menu_area_position != 'center') { ?>
						    <?php adorn_edge_get_sticky_menu('edge-sticky-nav'); ?>
                        <?php } ?>
                        <div class="edge-main-menu-widget-area">
                            <div class="edge-main-menu-widget-area-inner">
                                <?php adorn_edge_get_sticky_header_widget_menu_area(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php do_action('adorn_edge_end_of_page_header_html'); ?>
</div>

<?php do_action('adorn_edge_after_sticky_header'); ?>