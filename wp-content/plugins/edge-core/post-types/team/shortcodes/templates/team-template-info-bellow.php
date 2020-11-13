<div class="edge-team <?php echo esc_attr($team_member_layout) ?> <?php echo esc_attr($team_member_image_layout) ?>">
    <div class="edge-team-inner">
        <?php if (get_the_post_thumbnail($member_id) !== '') { ?>
            <div class="edge-team-image">
                <?php if($enable_link === 'yes'){?>
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>">
                    <?php }
                    if($team_member_image_layout == 'circle') {
                        echo get_the_post_thumbnail($member_id, 'adorn_square');
                    } else {
                        echo get_the_post_thumbnail($member_id, 'full');
                    }
                    ?>
                    <?php if($enable_link === 'yes'){?>
                </a>
            <?php }?>
            </div>
        <?php } ?>
        <div class="edge-team-info">
            <div class="edge-team-title-holder">
                <h5 itemprop="name" class="edge-team-name entry-title">
                    <?php if($enable_link === 'yes'){?>
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>">
                        <?php }?>
                        <?php echo esc_html($title) ?>
                        <?php if($enable_link === 'yes'){?>
                    </a>
                <?php }?>
                </h5>

                <?php if (!empty($position)) { ?>
                    <h6 class="edge-team-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
            <?php if (!empty($excerpt) && ($display_description === "yes") ) { ?>
                <div class="edge-team-text">
                    <div class="edge-team-text-inner">
                        <div class="edge-team-description">
                            <p itemprop="description" class="edge-team-excerpt"><?php echo esc_html($excerpt); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($display_social === "yes") { ?>
                <div class="edge-team-social-holder-between">
                    <div class="edge-team-social">
                        <div class="edge-team-social-inner">
                            <div class="edge-team-social-wrapp">
                                <?php foreach ($team_social_icons as $team_social_icon) {
									echo adorn_edge_get_module_part($team_social_icon);
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>