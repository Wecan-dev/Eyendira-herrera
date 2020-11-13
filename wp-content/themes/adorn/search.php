<?php
$edge_sidebar_layout = adorn_edge_sidebar_layout();

get_header();
adorn_edge_get_title();
?>
<div class="edge-container">
    <?php do_action('adorn_edge_after_container_open'); ?>
    <div class="edge-container-inner clearfix">
        <div class="edge-container">
            <?php do_action('adorn_edge_after_container_open'); ?>
            <div class="edge-container-inner">
	            <div class="edge-grid-row">
		            <div <?php echo adorn_edge_get_content_sidebar_class(); ?>>
                        <div class="edge-search-page-holder">
                            <form action="<?php echo esc_url(home_url('/')); ?>" class="edge-search-page-form" method="get">
                                <h2 class="edge-search-title"><?php esc_html_e('Search results:', 'adorn'); ?></h2>
                                <div class="edge-form-holder">
                                    <div class="edge-column-left">
                                        <input type="text" name="s" class="edge-search-field" autocomplete="off" value="" placeholder="<?php esc_attr_e('Type here', 'adorn'); ?>"/>
                                    </div>
                                    <div class="edge-column-right">
                                        <button type="submit" class="edge-search-submit"><span class="icon_search"></span></button>
                                    </div>
                                </div>
                                <div class="edge-search-label">
                                    <?php esc_html_e("If you are not happy with the results below please do another search", "adorn"); ?>
                                </div>
                            </form>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="edge-post-content">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <div class="edge-post-image">
                                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="edge-post-title-area <?php if (!has_post_thumbnail()) { echo esc_attr('edge-no-thumbnail'); } ?>">
                                            <div class="edge-post-title-area-inner">
                                                <h4 itemprop="name" class="edge-post-title entry-title">
                                                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                                <?php
                                                $edge_my_excerpt = get_the_excerpt();
                                                if ($edge_my_excerpt != '') { ?>
                                                    <p itemprop="description" class="edge-post-excerpt"><?php echo esc_html($edge_my_excerpt); ?></p>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <p class="edge-blog-no-posts"><?php esc_html_e('No posts were found.', 'adorn'); ?></p>
                            <?php endif; ?>
                            <?php
                                if ( get_query_var('paged') ) { $edge_paged = get_query_var('paged'); }
                                elseif ( get_query_var('page') ) { $edge_paged = get_query_var('page'); }
                                else { $edge_paged = 1; }

                                $edge_params['max_num_pages'] = adorn_edge_get_max_number_of_pages();
                                $edge_params['paged'] = $edge_paged;
                                adorn_edge_get_module_template_part('templates/parts/pagination/standard', 'blog', '', $edge_params);
                            ?>
                        </div>
                        <?php do_action('adorn_edge_page_after_content'); ?>
                    </div>
		            <?php if($edge_sidebar_layout !== 'no-sidebar') { ?>
			            <div <?php echo adorn_edge_get_sidebar_holder_class(); ?>>
				            <?php get_sidebar(); ?>
			            </div>
		            <?php } ?>
                </div>
				<?php do_action('adorn_edge_before_container_close'); ?>
            </div>
        </div>
    </div>
    <?php do_action('adorn_edge_before_container_close'); ?>
</div>
<?php get_footer(); ?>