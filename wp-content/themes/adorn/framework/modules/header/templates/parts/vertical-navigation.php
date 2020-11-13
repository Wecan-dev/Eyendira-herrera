<?php do_action('adorn_edge_before_top_navigation'); ?>
<div class="edge-vertical-menu-outer">
    <div class="edge-vertical-menu-inner">
        <nav class="edge-vertical-menu edge-vertical-dropdown-on-click">
            <?php
                wp_nav_menu(array(
                    'theme_location'  => 'vertical-navigation',
                    'container'       => '',
                    'container_class' => '',
                    'menu_class'      => '',
                    'menu_id'         => '',
                    'fallback_cb'     => 'top_navigation_fallback',
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                    'walker'          => new AdornEdgeTopNavigationWalker()
                ));
            ?>
        </nav>
        <div class="edge-vertical-area-top-widget-holder">
            <?php adorn_edge_get_header_vertical_widget_top_areas(); ?>
        </div>
    </div>
</div>
<?php do_action('adorn_edge_after_top_navigation'); ?>