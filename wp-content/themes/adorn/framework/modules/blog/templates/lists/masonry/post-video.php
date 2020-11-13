<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edge-post-content">
        <div class="edge-post-heading">
            <?php adorn_edge_get_module_template_part('templates/parts/post-type/video', 'blog', '', $part_params); ?>
        </div>
        <div class="edge-post-text">
            <div class="edge-post-text-inner">
                <div class="edge-post-info-top">
                    <?php adorn_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                </div>
                <div class="edge-post-text-main">
                    <?php adorn_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php adorn_edge_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php adorn_edge_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>