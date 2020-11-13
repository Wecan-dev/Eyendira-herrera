<?php
namespace EdgeCore\CPT\Shortcodes\ElementsHolderItem;

use EdgeCore\Lib;

class ElementsHolderItem implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'edge_elements_holder_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Edge Elements Holder Item', 'edge-core'),
					'base' => $this->base,
					'as_child' => array('only' => 'edge_elements_holder'),
					'as_parent' => array('except' => 'vc_row, vc_accordion'),
					'content_element' => true,
					'category' => esc_html__('by EDGE', 'edge-core'),
					'icon' => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__('Background Color', 'edge-core')
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__('Background Image', 'edge-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__('Padding', 'edge-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-core')
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_aligment',
							'heading'    => esc_html__('Horizontal Alignment', 'edge-core'),
							'value'      => array(
								esc_html__('Left', 'edge-core')    	=> 'left',
								esc_html__('Right', 'edge-core')     => 'right',
								esc_html__('Center', 'edge-core')    => 'center'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'vertical_alignment',
							'heading'    => esc_html__('Vertical Alignment', 'edge-core'),
							'value'      => array(
								esc_html__('Middle', 'edge-core')    => 'middle',
								esc_html__('Top', 'edge-core')    	=> 'top',
								esc_html__('Bottom', 'edge-core')    => 'bottom'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'animation',
							'heading'    => esc_html__('Animation Type', 'edge-core'),
							'value'      => array(
								esc_html__('Default (No Animation)', 'edge-core') => '',
								esc_html__('Element Grow In', 'edge-core') => 'edge-grow-in',
								esc_html__('Element Fade In Down', 'edge-core') => 'edge-fade-in-down',
								esc_html__('Element From Fade', 'edge-core') => 'edge-element-from-fade',
								esc_html__('Element From Left', 'edge-core') => 'edge-element-from-left',
								esc_html__('Element From Right', 'edge-core') => 'edge-element-from-right',
								esc_html__('Element From Top', 'edge-core') => 'edge-element-from-top',
								esc_html__('Element From Bottom', 'edge-core') => 'edge-element-from-bottom',
								esc_html__('Element Flip In', 'edge-core') => 'edge-flip-in',
								esc_html__('Element X Rotate', 'edge-core') => 'edge-x-rotate',
								esc_html__('Element Z Rotate', 'edge-core') => 'edge-z-rotate',
								esc_html__('Element Y Translate', 'edge-core') => 'edge-y-translate',
								esc_html__('Element Fade In X Rotate', 'edge-core') => 'edge-fade-in-left-x-rotate',
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__('Animation Delay (ms)', 'edge-core')
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding_1280_1600',
                            'heading'     => esc_html__('Padding on screen size between 1280px-1600px', 'edge-core'),
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-core'),
                            'group'       => esc_html__('Width & Responsiveness', 'edge-core')
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1024_1280',
							'heading'     => esc_html__('Padding on screen size between 1024px-1280px', 'edge-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-core'),
							'group'       => esc_html__('Width & Responsiveness', 'edge-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_768_1024',
							'heading'     => esc_html__('Padding on screen size between 768px-1024px', 'edge-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-core'),
							'group'       => esc_html__('Width & Responsiveness', 'edge-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_600_768',
							'heading'     => esc_html__('Padding on screen size between 600px-768px', 'edge-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-core'),
							'group'       => esc_html__('Width & Responsiveness', 'edge-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480_600',
							'heading'     => esc_html__('Padding on screen size between 480px-600px', 'edge-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-core'),
							'group'       => esc_html__('Width & Responsiveness', 'edge-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480',
							'heading'     => esc_html__('Padding on Screen Size Bellow 480px', 'edge-core'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-core'),
							'group'       => esc_html__('Width & Responsiveness', 'edge-core')
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'background_color'          => '',
			'background_image'          => '',
			'item_padding'              => '',
			'horizontal_aligment'       => '',
			'vertical_alignment'        => '',
            'item_padding_1280_1600'    => '',
			'item_padding_1024_1280'    => '',
			'item_padding_768_1024'     => '',
			'item_padding_600_768'      => '',
			'item_padding_480_600'      => '',
			'item_padding_480'          => '',
			'animation'                 => '',
			'animation_delay'           => ''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;

		$rand_class = 'edge-eh-custom-' . mt_rand(100000,1000000);

		$params['elements_holder_item_style']           = $this->getElementsHolderItemStyles($params);
		$params['elements_holder_item_content_style']   = $this->getElementsHolderItemContentStyles($params);
		$params['elements_holder_item_class']           = $this->getElementsHolderItemClass($params);
		$params['elements_holder_item_content_class']   = $rand_class;
		$params['elements_holder_item_responsive_data'] = $this->getElementsHolderItemContentResponsiveData($params);

		$html = edge_core_get_shortcode_module_template_part('templates/elements-holder-item-template', 'elements-holder', '', $params);

		return $html;
	}
	
	/**
	 * Return Elements Holder Item style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemStyles($params) {
		$styles = array();

		if ($params['background_color'] !== '') {
			$styles[] = 'background-color: '.$params['background_color'];
		}
		
		if ($params['background_image'] !== '') {
			$styles[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
		}

		return implode(';', $styles);
	}

	/**
	 * Return Elements Holder Item Content style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentStyles($params) {
		$styles = array();

		if ($params['item_padding'] !== '') {
			$styles[] = 'padding: '.$params['item_padding'];
		}

		return implode(';', $styles);
	}

	/**
	 * Return Elements Holder Item classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemClass($params) {
		$classes = array();
		
		if (!empty($params['vertical_alignment'])) {
			$classes[] = 'edge-vertical-alignment-'. $params['vertical_alignment'];
		}
		
		if (!empty($params['horizontal_aligment'])) {
			$classes[] = 'edge-horizontal-alignment-'. $params['horizontal_aligment'];
		}
		
		if (!empty($params['animation'])) {
			$classes[] = esc_attr($params['animation']);
		}
		
		return implode(' ', $classes);
	}

	/**
	 * Return Elements Holder Item Content Responssive data
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentResponsiveData($params) {
		$data = array();
		$data['data-item-class'] = $params['elements_holder_item_content_class'];
		
		if (!empty($params['animation'])) {
			$data['data-animation'] = $params['animation'];
		}
		
		if ($params['animation_delay'] !== '') {
			$data['data-animation-delay'] = esc_attr($params['animation_delay']);
		}

		if ($params['item_padding_1280_1600'] !== '') {
			$data['data-1280-1600'] = $params['item_padding_1280_1600'];
		}

		if ($params['item_padding_1024_1280'] !== '') {
			$data['data-1024-1280'] = $params['item_padding_1024_1280'];
		}

		if ($params['item_padding_768_1024'] !== '') {
			$data['data-768-1024'] = $params['item_padding_768_1024'];
		}

		if ($params['item_padding_600_768'] !== '') {
			$data['data-600-768'] = $params['item_padding_600_768'];
		}

		if ($params['item_padding_480_600'] !== '') {
			$data['data-480-600'] = $params['item_padding_480_600'];
		}

		if ($params['item_padding_480'] !== '') {
			$data['data-480'] = $params['item_padding_480'];
		}

		return $data;
	}
}
