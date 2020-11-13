<?php

class AdornEdgeButtonWidget extends AdornEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edge_button_widget',
			esc_html__('Edge Button Widget', 'adorn'),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'adorn'))
		);

		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__('Type', 'adorn'),
				'options' => array(
					'solid'   => esc_html__('Solid', 'adorn'),
					'outline' => esc_html__('Outline', 'adorn'),
					'simple'  => esc_html__('Simple', 'adorn')
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'size',
				'title'   => esc_html__('Size', 'adorn'),
				'options' => array(
					'small'  => esc_html__('Small', 'adorn'),
					'medium' => esc_html__('Medium', 'adorn'),
					'large'  => esc_html__('Large', 'adorn'),
					'huge'   => esc_html__('Huge', 'adorn')
				),
				'description' => esc_html__('This option is only available for solid and outline button type', 'adorn')
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__('Text', 'adorn'),
				'default' => esc_html__('Button Text', 'adorn')
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__('Link', 'adorn')
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__('Link Target', 'adorn'),
				'options' => adorn_edge_get_link_target_array()
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__('Color', 'adorn')
			),
			array(
				'type'  => 'textfield',
				'name'  => 'hover_color',
				'title' => esc_html__('Hover Color', 'adorn')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'background_color',
				'title'       => esc_html__('Background Color', 'adorn'),
				'description' => esc_html__('This option is only available for solid button type', 'adorn')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_background_color',
				'title'       => esc_html__('Hover Background Color', 'adorn'),
				'description' => esc_html__('This option is only available for solid button type', 'adorn')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'border_color',
				'title'       => esc_html__('Border Color', 'adorn'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'adorn')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_border_color',
				'title'       => esc_html__('Hover Border Color', 'adorn'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'adorn')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__('Margin', 'adorn'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'adorn')
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
		$params = '';

		if (!is_array($instance)) { $instance = array(); }

		// Filter out all empty params
		$instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

		// Default values
		if (!isset($instance['text'])) { $instance['text'] = 'Button Text'; }

		// Generate shortcode params
		foreach($instance as $key => $value) {
			$params .= " $key='$value' ";
		}

		echo '<div class="widget edge-button-widget">';
			echo do_shortcode("[edge_button $params]"); // XSS OK
		echo '</div>';
	}
}