<aside class="edge-sidebar">
    <?php
        $edge_sidebar = adorn_edge_get_sidebar();
    
        if (is_active_sidebar($edge_sidebar)) {
            dynamic_sidebar($edge_sidebar);
        }
    ?>
</aside>