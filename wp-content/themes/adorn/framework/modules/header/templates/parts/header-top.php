<?php if($show_header_top) : ?>

<?php do_action('adorn_edge_before_header_top'); ?>

<div class="edge-top-bar">
    <?php if($top_bar_in_grid) : ?>
    <div class="edge-grid">
    <?php endif; ?>
		<?php do_action( 'adorn_edge_after_header_top_html_open' ); ?>
        <div class="edge-vertical-align-containers <?php echo esc_attr($column_widths); ?>">
            <div class="edge-position-left">
                <div class="edge-position-left-inner">
                    <?php if(is_active_sidebar('edge-top-bar-left')) : ?>
                        <?php dynamic_sidebar('edge-top-bar-left'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($show_widget_center){ ?>
                <div class="edge-position-center">
                    <div class="edge-position-center-inner">
                        <?php if(is_active_sidebar('edge-top-bar-center')) : ?>
                            <?php dynamic_sidebar('edge-top-bar-center'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } ?>
            <div class="edge-position-right">
                <div class="edge-position-right-inner">
                    <?php if(is_active_sidebar('edge-top-bar-right')) : ?>
                        <?php dynamic_sidebar('edge-top-bar-right'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php if($top_bar_in_grid) : ?>
    </div>
    <?php endif; ?>
</div>

<?php do_action('adorn_edge_after_header_top'); ?>

<?php endif; ?>