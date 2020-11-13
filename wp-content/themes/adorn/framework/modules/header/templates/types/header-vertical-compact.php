<?php do_action('adorn_edge_before_page_header'); ?>
<aside class="edge-vertical-menu-area edge-with-scroll">
    <div class="edge-vertical-menu-area-inner">
        <div class="edge-vertical-area-background"></div>
        <?php if(!$hide_logo) {
            adorn_edge_get_logo();
        } ?>
        <?php adorn_edge_get_vertical_main_menu('compact'); ?>
        <div class="edge-vertical-area-widget-holder">
			<?php adorn_edge_get_header_vertical_widget_areas(); ?>
        </div>
    </div>
</aside>
<?php do_action('adorn_edge_after_page_header'); ?>