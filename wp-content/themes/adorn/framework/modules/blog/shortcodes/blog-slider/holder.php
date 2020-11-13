<div class="edge-blog-slider-holder">
    <ul class="edge-blog-slider edge-owl-slider" <?php echo adorn_edge_get_inline_attrs($slider_data); ?>>
        <?php
            if($query_result->have_posts()):
                while ($query_result->have_posts()) : $query_result->the_post();
                    adorn_edge_get_module_template_part('shortcodes/blog-slider/layout-collections/blog-slide', 'blog', '', $params);
                endwhile;
            else: ?>
                <div class="edge-blog-slider-messsage">
                    <p><?php esc_html_e('No posts were found.', 'adorn'); ?></p>
                </div>
            <?php endif;

            wp_reset_postdata();
        ?>
    </ul>
</div>
