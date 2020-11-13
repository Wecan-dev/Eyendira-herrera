<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edge-post-content">
        <div class="edge-post-text">
            <div class="edge-post-text-inner">
                <div class="edge-post-text-main">
                    <?php adorn_edge_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="edge-post-additional-content">
        <?php the_content(); ?>
    </div>
    <div class="edge-post-info-bottom clearfix">
        <?php adorn_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
    </div>
</article>