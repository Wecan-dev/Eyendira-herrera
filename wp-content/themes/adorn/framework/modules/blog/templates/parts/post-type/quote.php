<?php
$title_tag = isset($quote_tag) ? $quote_tag : 'h5';
$quote_text_meta = get_post_meta(get_the_ID(), "edge_post_quote_text_meta", true );

$post_title = !empty($quote_text_meta) ? $quote_text_meta : get_the_title();

$post_author = get_post_meta(get_the_ID(), "edge_post_quote_author_meta", true );
?>

<div class="edge-post-quote-holder">
    <div class="edge-post-quote-holder-inner">
        <<?php echo esc_attr($title_tag);?> itemprop="name" class="edge-quote-title edge-post-title">
        <?php if(adorn_edge_blog_item_has_link()) { ?>
            <a itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php } ?>
            <span>&#8220;</span><?php echo esc_html($post_title); ?><span>&#8221;</span>
        <?php if(adorn_edge_blog_item_has_link()) { ?>
            </a>
        <?php } ?>
        </<?php echo esc_attr($title_tag);?>>
        <span class="edge-quote-author">
            <?php echo esc_html($post_author); ?>
        </span>
    </div>
</div>