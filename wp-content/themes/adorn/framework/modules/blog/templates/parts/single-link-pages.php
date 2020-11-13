<?php
$args_pages = array(
    'before'           => '<div class="edge-single-links-pages"><div class="edge-single-links-pages-inner">',
    'after'            => '</div></div>',
    'link_before'      => '<span>'. esc_html__('Page ', 'adorn'),
    'link_after'       => '</span>',
    'pagelink'         => '%'
);

wp_link_pages($args_pages);