<?php
namespace EdgeCore\CPT\Shortcodes\PricingTables;

use EdgeCore\Lib;

class PricingTables implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Edge Pricing Tables', 'edge-core'),
				'base' => $this->base,
				'as_parent' => array('only' => 'edge_pricing_table'),
				'content_element' => true,
				'category' => esc_html__('by EDGE', 'edge-core'),
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'js_view' => 'VcColumnView',
				'params' => array(
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Number of Columns', 'edge-core'),
						'param_name' => 'columns',
						'value' => array(
							esc_html__('One', 'edge-core') => 'edge-one-column',
							esc_html__('Two', 'edge-core') => 'edge-two-columns',
							esc_html__('Three', 'edge-core') => 'edge-three-columns',
							esc_html__('Four', 'edge-core') => 'edge-four-columns',
							esc_html__('Five', 'edge-core') => 'edge-five-columns',
						)
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_columns',
						'heading'    => esc_html__('Space Between Columns', 'edge-core'),
						'value'      => array(
							esc_html__('Normal', 'edge-core') => 'normal',
							esc_html__('Small', 'edge-core') => 'small',
							esc_html__('Tiny', 'edge-core') => 'tiny',
							esc_html__('No Space', 'edge-core') => 'no'
						)
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         	    => 'edge-two-columns',
			'space_between_columns' => 'normal'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$holder_class = '';
		
		if (!empty($columns)) {
			$holder_class .= ' '.$columns;
		}

		if (!empty($space_between_columns)) {
			$holder_class .= ' edge-pt-'.$space_between_columns.'-space';
		}
		
		$html = '<div class="edge-pricing-tables clearfix '.esc_attr($holder_class).'">';
			$html .= '<div class="edge-pt-wrapper">';
				$html .= do_shortcode($content);
			$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}