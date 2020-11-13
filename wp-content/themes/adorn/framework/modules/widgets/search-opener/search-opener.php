<?php

class AdornEdgeSearchOpener extends AdornEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edge_search_opener',
	        esc_html__('Edge Search Opener', 'adorn'),
	        array( 'description' => esc_html__( 'Display a "search" icon that opens the search form', 'adorn'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_size',
                'title'       => esc_html__('Icon Size (px)', 'adorn'),
                'description' => esc_html__('Define size for search icon', 'adorn')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_color',
                'title'       => esc_html__('Icon Color', 'adorn'),
                'description' => esc_html__('Define color for search icon', 'adorn')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_hover_color',
                'title'       => esc_html__('Icon Hover Color', 'adorn'),
                'description' => esc_html__('Define hover color for search icon', 'adorn')
            ),
	        array(
		        'type' => 'textfield',
		        'name' => 'search_icon_margin',
		        'title' => esc_html__('Icon Margin', 'adorn'),
		        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'adorn')
	        ),
            array(
	            'type'        => 'dropdown',
	            'name'        => 'show_label',
                'title'       => esc_html__('Enable Search Icon Text', 'adorn'),
                'description' => esc_html__('Enable this option to show search text next to search icon in header', 'adorn'),
                'options'     => adorn_edge_get_yes_no_select_array()
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $adorn_options, $adorn_IconCollections;

	    $search_type_class    = 'edge-search-opener edge-icon-has-hover';
	    $styles = array();
	    $show_search_text     = $instance['show_label'] == 'yes' || $adorn_options['enable_search_icon_text'] == 'yes' ? true : false;

	    if(!empty($instance['search_icon_size'])) {
		    $styles[] = 'font-size: '.intval($instance['search_icon_size']).'px';
	    }

	    if(!empty($instance['search_icon_color'])) {
		    $styles[] = 'color: '.$instance['search_icon_color'].';';
	    }

	    if (!empty($instance['search_icon_margin'])) {
		    $styles[] = 'margin: ' . $instance['search_icon_margin'].';';
	    }
	    ?>

	    <a <?php adorn_edge_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?> <?php adorn_edge_inline_style($styles); ?>
		    <?php adorn_edge_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <span class="edge-search-opener-wrapper">
                <?php if(isset($adorn_options['search_icon_pack'])) {
	                $adorn_IconCollections->getSearchIcon($adorn_options['search_icon_pack'], false);
                } ?>
	            <?php if($show_search_text) { ?>
		            <span class="edge-search-icon-text"><?php esc_html_e('Search', 'adorn'); ?></span>
	            <?php } ?>
            </span>
	    </a>
    <?php }
}