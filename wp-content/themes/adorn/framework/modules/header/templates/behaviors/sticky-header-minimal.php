<?php do_action('adorn_edge_after_sticky_header'); ?>

<div class="edge-sticky-header">
    <?php do_action('adorn_edge_after_sticky_menu_html_open'); ?>
    <div class="edge-sticky-holder">
        <?php if ($sticky_header_in_grid) : ?>
        <div class="edge-grid">
            <?php endif; ?>
            <div class=" edge-vertical-align-containers">
                <div class="edge-position-left">
                    <div class="edge-position-left-inner">
                        <?php if (!$hide_logo) {
                            adorn_edge_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="edge-position-right">
                    <div class="edge-position-right-inner">
                        <a href="javascript:void(0)" class="edge-fullscreen-menu-opener">
                                <span class="edge-fm-lines">
									<span class="edge-fm-line edge-line-1"></span>
									<span class="edge-fm-line edge-line-2"></span>
									<span class="edge-fm-line edge-line-3"></span>
								</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($sticky_header_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php do_action('adorn_edge_after_sticky_header'); ?>
