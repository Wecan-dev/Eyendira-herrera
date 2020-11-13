<div class="edge-testimonial-content" id="edge-testimonials-<?php echo esc_attr($current_id) ?>">
    <div class="edge-testimonial-text-holder">
        <?php if(!empty($title) && $title !== null) { ?>
            <h3 itemprop="name" class="edge-testimonial-title entry-title"><?php echo esc_html($title); ?></h3>
        <?php } else { ?>
            <h1 itemprop="name" class="edge-testimonial-title entry-title-none">,,</h1>
        <?php } ?>
        <?php if(!empty($text)) { ?>
            <p class="edge-testimonial-text"><?php echo esc_html($text); ?></p>
        <?php } ?>
        <?php if(has_post_thumbnail()) { ?>
            <div class="edge-testimonial-image">
                <?php echo get_the_post_thumbnail(get_the_ID(), array(66, 66)); ?>
            </div>
        <?php } ?>
        <?php if(!empty($author) || !empty($position)) {?>
        <div class="<?php
        if ($position_placement == 'left'){
            echo 'edge-testimonial-left-placement'; };
        if ($position_placement == 'under'){
            echo 'edge-testimonial-under-placement'; };
        } ?> ">

            <?php if(!empty($author)) { ?>
                <h5 class="edge-testimonial-author"><?php echo esc_html($author); ?></h5>
            <?php } ?>
            <?php if(!empty($position)) { ?>
                <h5 class="edge-testimonial-position"><?php echo esc_html($position); ?></h5>
            <?php } ?>
            <?php if(!empty($author) || !empty($position)) {?>
        </div>
    <?php }?>
    </div>
</div>