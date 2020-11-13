<?php
$blog_single_navigation = adorn_edge_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = adorn_edge_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
    <div class="edge-blog-single-navigation">
        <div class="edge-blog-single-navigation-inner clearfix">
            <?php
            /* Single navigation section - SETTING PARAMS */
            $same_cat_flag = false;
            if($blog_navigation_through_same_category){
                $same_cat_flag = true;
            }
            $prevPost = get_previous_post($same_cat_flag);
            $nextPost = get_next_post($same_cat_flag);

            if(isset($prevPost) && $prevPost !== '' && $prevPost !== null){

                $post_navigation['prev']['post'] = $prevPost;

                $post_navigation['prev']['classes'] = array(
                    'edge-blog-single-nav-prev'
                );

                $image = get_the_post_thumbnail($prevPost->ID);
                $post_navigation['prev']['image'] = '';

                if($image !== ''){
                    $post_navigation['prev']['image'] = '<div class="edge-blog-single-nav-thumbnail">'.wp_kses_post($image).'</div>';
                    $post_navigation['prev']['classes'][] = 'edge-with-image';
                }

                $post_navigation['prev']['label'] = '<span class="edge-blog-single-nav-label">'.esc_html__('Previous', 'adorn').'</span>';
                $post_navigation['prev']['title'] = '<h4 class="edge-blog-single-nav-title">'.get_the_title($prevPost->ID).'</h4>';

            }

            if(isset($nextPost) && $nextPost !== '' && $nextPost !== null){

                $post_navigation['next']['post'] = $nextPost;

                $post_navigation['next']['classes'] = array(
                    'edge-blog-single-nav-next'
                );

                $image = get_the_post_thumbnail($nextPost->ID);
                $post_navigation['next']['image'] = '';

                if($image !== ''){
                    $post_navigation['next']['image'] = '<div class="edge-blog-single-nav-thumbnail">'.wp_kses_post($image).'</div>';
                    $post_navigation['next']['classes'][] = 'edge-with-image';
                }

                $post_navigation['next']['label'] = '<span class="edge-blog-single-nav-label">'.esc_html__('Next', 'adorn').'</span>';
                $post_navigation['next']['title'] = '<h4 class="edge-blog-single-nav-title">'.get_the_title($nextPost->ID).'</h4>';

            }


            /* Single navigation section - RENDERING */
            foreach (array('prev', 'next') as $nav_type) {

                if(isset($post_navigation[$nav_type])){ ?>

                    <div class="<?php echo implode(' ', $post_navigation[$nav_type]['classes']) ?>">
                        <a itemprop="url" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
                            <?php
                            echo wp_kses_post($post_navigation[$nav_type]['image']);
                            echo wp_kses_post($post_navigation[$nav_type]['title']);
                            echo wp_kses_post($post_navigation[$nav_type]['label']);
                            ?>
                        </a>
                    </div>

                <?php }

            }

            ?>
        </div>
    </div>
<?php } ?>