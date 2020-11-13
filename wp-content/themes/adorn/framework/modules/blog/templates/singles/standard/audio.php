<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edge-post-content">
        <div class="edge-post-heading">
            <?php adorn_edge_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
            <?php adorn_edge_get_module_template_part('templates/parts/post-type/audio', 'blog', '', $part_params); ?>
        </div>
        <div class="edge-post-text">
            <div class="edge-post-text-inner">
                <div class="edge-post-info-top">
                    <?php adorn_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php adorn_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
                <div class="edge-post-text-main">
                    <?php the_content(); ?>
                    <?php do_action('adorn_edge_single_link_pages'); ?>
                </div>
                <div class="edge-post-info-bottom clearfix">
                    <?php adorn_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>