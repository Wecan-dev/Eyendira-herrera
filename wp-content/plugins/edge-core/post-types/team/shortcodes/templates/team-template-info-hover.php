<div class="edge-team <?php echo esc_attr($team_member_layout) ?>">
    <div class="edge-team-inner">
        <?php if (get_the_post_thumbnail($member_id) !== '') { ?>
            <div class="edge-team-image">
                <?php echo get_the_post_thumbnail($member_id); ?>
                <div class="edge-team-info-tb">
                    <div class="edge-team-info-tc">
                        <div class="edge-team-title-holder">
                            <h5 itemprop="name" class="edge-team-name entry-title">
                                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                            </h5>
                            <?php if (!empty($position)) { ?>
                                <h6 class="edge-team-position"><?php echo esc_html($position); ?></h6>
                            <?php } ?>
                        </div>
                        <div class="edge-team-social-holder-between">
                            <div class="edge-team-social">
                                <div class="edge-team-social-inner">
                                    <div class="edge-team-social-wrapp">
                                        <?php foreach($team_social_icons as $team_social_icon) {
											echo adorn_edge_get_module_part($team_social_icon);
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>