<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edge-post-content">
        <div class="edge-post-text">
            <div class="edge-post-text-inner">
                <div class="edge-post-text-main">
                    <?php adorn_edge_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>