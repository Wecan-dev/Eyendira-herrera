<?php
namespace EdgeCore\CPT\Shortcodes\VerticalSplitSlider;

use EdgeCore\Lib;

class VerticalSplitSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_vertical_split_slider';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Vertical Split Slider', 'edge-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-vertical-split-slider extended-custom-icon',
			'category' => esc_html__('by EDGE', 'edge-core'),
			'as_parent'	=> array('only' => 'edge_vertical_split_slider_left_panel, edge_vertical_split_slider_right_panel'),
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'custom_sidebar',
					'heading'    => esc_html__('Custom Sidebar', 'edge-core'),
					'description'=> esc_html__('Choose custom sidebar to be displayed over Vertical Split slider', 'edge-core'),
					'value'      => adorn_edge_get_custom_sidebars(true)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'custom_sidebar'	=> '',
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['content'] = $content;

//		$html .= '<div class="edge-vertical-split-slider">';
//		if($custom_sidebar !== ''){
//			$html .= '<div class="edge-vertical-split-slider-widget-area">';
//			$html .= dynamic_sidebar($custom_sidebar);
//			$html .= '</div>';
//		}
//		$html .= do_shortcode($content);
//		$html .= '</div>';

		$html = edge_core_get_shortcode_module_template_part('templates/vertical-split-slider-template', 'vertical-split-slider', '', $params);

		return $html;
	}
}
