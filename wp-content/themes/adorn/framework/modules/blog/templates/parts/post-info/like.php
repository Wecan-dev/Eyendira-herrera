<?php if( adorn_edge_core_plugin_installed() ) { ?>
    <div class="edge-blog-like">
        <?php if( function_exists('adorn_edge_get_like') ) adorn_edge_get_like(); ?>
    </div>
<?php } ?>