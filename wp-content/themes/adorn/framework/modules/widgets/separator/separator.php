<?php

class AdornEdgeSeparatorWidget extends AdornEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edge_separator_widget',
	        esc_html__('Edge Separator Widget', 'adorn'),
	        array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'adorn'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'name' => 'type',
                'title' => esc_html__('Type', 'adorn'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'adorn'),
                    'full-width' => esc_html__('Full Width', 'adorn')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'position',
                'title' => esc_html__('Position', 'adorn'),
                'options' => array(
                    'center' => esc_html__('Center', 'adorn'),
                    'left' => esc_html__('Left', 'adorn'),
                    'right' => esc_html__('Right', 'adorn')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'border_style',
                'title' => esc_html__('Style', 'adorn'),
                'options' => array(
                    'solid' => esc_html__('Solid', 'adorn'),
                    'dashed' => esc_html__('Dashed', 'adorn'),
                    'dotted' => esc_html__('Dotted', 'adorn')
                )
            ),
            array(
                'type' => 'textfield',
                'name' => 'color',
                'title' => esc_html__('Color', 'adorn')
            ),
            array(
                'type' => 'textfield',
                'name' => 'width',
                'title' => esc_html__('Width', 'adorn')
            ),
            array(
                'type' => 'textfield',
                'name' => 'thickness',
                'title' => esc_html__('Thickness (px)', 'adorn')
            ),
            array(
                'type' => 'textfield',
                'name' => 'top_margin',
                'title' => esc_html__('Top Margin', 'adorn')
            ),
            array(
                'type' => 'textfield',
                'name' => 'bottom_margin',
                'title' => esc_html__('Bottom Margin', 'adorn')
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
        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget edge-separator-widget">';
            echo do_shortcode("[edge_separator $params]"); // XSS OK
        echo '</div>';
    }
}