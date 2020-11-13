<?php

class AdornEdgeBlogListWidget extends AdornEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edge_blog_list_widget',
            esc_html__('Edge Blog List Widget', 'adorn'),
            array( 'description' => esc_html__( 'Display a list of your blog posts', 'adorn'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__('Widget Title', 'adorn')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'type',
                'title'   => esc_html__('Type', 'adorn'),
                'options' => array(
                    'simple'  => esc_html__('Simple', 'adorn'),
                    'minimal' => esc_html__('Minimal', 'adorn')
                )
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'number_of_posts',
                'title' => esc_html__('Number of Posts', 'adorn')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'space_between_columns',
                'title'   => esc_html__('Space Between items', 'adorn'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'adorn'),
                    'small'  => esc_html__('Small', 'adorn'),
                    'tiny'   => esc_html__('Tiny', 'adorn'),
                    'no'     => esc_html__('No Space', 'adorn')
                )
            ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'order_by',
		        'title'   => esc_html__('Order By', 'adorn'),
		        'options' => adorn_edge_get_query_order_by_array()
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'order',
		        'title'   => esc_html__('Order', 'adorn'),
		        'options' => adorn_edge_get_query_order_array()
	        ),
            array(
                'type'        => 'textfield',
                'name'        => 'category',
                'title'       => esc_html__('Category Slug', 'adorn'),
                'description' => esc_html__('Leave empty for all or use comma for list', 'adorn')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_tag',
                'title'   => esc_html__('Title Tag', 'adorn'),
                'options' => adorn_edge_get_title_tag(true)
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_transform',
                'title'   => esc_html__('Title Text Transform', 'adorn'),
                'options' => adorn_edge_get_text_transform_array(true)
            ),
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        $params = '';

        if (!is_array($instance)) { $instance = array(); }

        $instance['post_info_section'] = 'yes';
        $instance['number_of_columns'] = '1';

        // Filter out all empty params
        $instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

        //generate shortcode params
        foreach($instance as $key => $value) {
            $params .= " $key='$value' ";
        }

        $available_types = array('simple', 'classic');

        if (!in_array($instance['type'], $available_types)) {
            $instance['type'] = 'simple';
        }

        echo '<div class="widget edge-blog-list-widget">';
            if(!empty($instance['widget_title'])) {
	            echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
            }

            echo do_shortcode("[edge_blog_list $params]"); // XSS OK
        echo '</div>';
    }
}