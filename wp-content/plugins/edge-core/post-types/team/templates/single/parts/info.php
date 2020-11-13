<div class="edge-team-single-info-holder">
    <div class="edge-grid-row">
        <div class="edge-ts-image-holder edge-grid-col-4">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="edge-ts-details-holder edge-grid-col-8">
            <h2 class="edge-name"><?php the_title(); ?></h2>
            <p class="edge-position"><?php echo esc_html($position); ?>
                <?php foreach ($social_icons as $social_icon) {
					echo adorn_edge_get_module_part($social_icon);
                } ?>
            </p>
            <div class="edge-ts-bio-holder">
                <?php if(!empty($birth_date)) { ?>
                    <div class="edge-grid-col-6">
                        <div class="edge-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_calendar icon"></span>
                            <span class="info"><?php echo esc_html('born on: ', 'edge-core').esc_html($birth_date); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($address)) { ?>
                    <div class="edge-grid-col-6">
                        <div class="edge-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_building icon"></span>
                            <span class="info"><?php echo esc_html('lives in: ', 'edge-core').esc_html($address); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($email)) { ?>
                    <div class="edge-grid-col-6">
                        <div class="edge-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_mail_alt icon"></span>
                            <span class="info"><?php echo esc_html('email: ', 'edge-core').esc_html($email); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($education)) { ?>
                    <div class="edge-grid-col-6">
                        <div class="edge-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_ribbon icon"></span>
                            <span class="info"><?php echo esc_html('education: ', 'edge-core').esc_html($education); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($phone)) { ?>
                    <div class="edge-grid-col-6">
                        <div class="edge-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_phone icon"></span>
                            <span class="info"><?php echo esc_html('phone: ', 'edge-core').esc_html($phone); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($resume)) { ?>
                    <div class="edge-grid-col-6">
                        <div class="edge-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_document_alt icon"></span>
                            <a href="<?php echo esc_url($resume); ?>" download target="_blank"><span class="info"><?php echo esc_html('download Resume', 'edge-core'); ?></span></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
	</div>
</div>