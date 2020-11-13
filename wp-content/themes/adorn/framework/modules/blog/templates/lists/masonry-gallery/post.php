<?php
$image_proportion = adorn_edge_get_meta_field_intersect('blog_list_featured_image_proportion', adorn_edge_get_page_id());
$image_proportion_value = get_post_meta(get_the_ID(), 'edge_blog_masonry_gallery_' . $image_proportion .'_dimensions_meta', true);

if (isset($image_proportion_value) && $image_proportion_value !== '') {
    $size = $image_proportion_value !== '' ? $image_proportion_value : 'default';
    $post_classes[] = 'edge-post-size-'. $size;
}
else {
    $size = 'default';
    $post_classes[] = 'edge-post-size-default';
}
if($image_proportion == 'original') {
    $part_params['featured_image_size'] = 'full';
}
else {
    switch ($size):
        case 'default':
            $part_params['featured_image_size'] = 'adorn_square';
            break;
        case 'large-width':
            $part_params['featured_image_size'] = 'adorn_landscape';
            break;
        case 'large-height':
            $part_params['featured_image_size'] = 'adorn_portrait';
            break;
        case 'large-width-height':
            $part_params['featured_image_size'] = 'adorn_huge';
            break;
        default:
            $part_params['featured_image_size'] = 'adorn_square';
            break;
    endswitch;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edge-post-content">
        <?php adorn_edge_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
        <div class="edge-post-text">
            <div class="edge-post-text-inner">
                <div class="edge-post-info">
                    <?php adorn_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php adorn_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <?php adorn_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                <?php adorn_edge_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                <div class="edge-post-info">
                    <?php adorn_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
        <a itemprop="url" class="edge-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
    </div>
</article>