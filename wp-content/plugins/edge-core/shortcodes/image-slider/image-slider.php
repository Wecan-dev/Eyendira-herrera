<?php
namespace EdgeCore\CPT\Shortcodes\ImageSlider;

use EdgeCore\Lib;

class ImageSlider implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'edge_image_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Edge Image Slider', 'edge-core'),
			'base'                      => $this->getBase(),
			'category'                  => esc_html__('by EDGE', 'edge-core'),
			'icon' 						=> 'icon-wpb-image-slider extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'param_group',
					'heading' => esc_html__('Content Item', 'edge-core '),
					'param_name' => 'content_item',
					'value' => '',
					'params' => array(
						array(
							'type' => 'attach_image',
							'heading' => esc_html__('Image', 'edge-core'),
							'param_name' => 'image',
							'description' => '',
							'admin_label' => true
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Title', 'edge-core'),
							'param_name' => 'title',
							'description' => '',
							'admin_label' => true
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Content', 'edge-core'),
							'param_name' => 'content',
							'description' => '',
							'admin_label' => true
						),
					)
				),
                array(
                    'type'		  => 'dropdown',
                    'param_name'  => 'enable_navigation',
                    'heading'	  => esc_html__('Enable Navigarion', 'edge-core'),
                    'value'       => array_flip(adorn_edge_get_yes_no_select_array(false))
                ),
                array(
                    'type'		  => 'dropdown',
                    'param_name'  => 'enable_pagination',
                    'heading'	  => esc_html__('Enable Pagination', 'edge-core'),
                    'value'       => array_flip(adorn_edge_get_yes_no_select_array(false))
                ),
			)
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'content_item' => '',
            'enable_navigation' => 'yes',
            'enable_pagination' => 'no'
		);

		$params = shortcode_atts($args, $atts);
		$params['all_items'] = json_decode(urldecode($params['content_item']), true);
		$params['all_items'] = $this->generateImageSrcToParamArray($params['all_items']);
		$params['data_params'] = $this->generateDataParams($params);

		$html = edge_core_get_shortcode_module_template_part('templates/holder', 'image-slider', '', $params);

		return $html;
	}

	/**
	 * @param $params
	 */
	public function generateDataParams($params){
		$data_params = array(
			'data-enable-autoplay'   => 'yes',
			'data-slider-animate-in' => 'fadeIn',
            'data-slider-animate-out' => 'fadeOut',
		);

        $data_params['data-enable-navigation'] = ($params['enable_navigation'] === 'yes') ? 'yes' : 'no';
        $data_params['data-enable-pagination'] = ($params['enable_pagination'] === 'yes') ? 'yes' : 'no';

		return $data_params;

	}

	function generateImageSrcToParamArray($items){

		if(is_array($items) && count($items)){

			foreach ($items as $item_key => $item){
				if(isset($item['image']) && $item['image'] !== '' ){

					$image_url_obj = wp_get_attachment_image_src($item['image'], 'full');
					$items[$item_key]['image_style']= '';
					$items[$item_key]['image_url']= '';

					if($image_url_obj && $image_url_obj !== ''){
						$items[$item_key]['image_style'] = 'background-image: url('.esc_url($image_url_obj[0]).')';
						$items[$item_key]['image_url'] = $image_url_obj[0];
					}

				}

			}

		}

		return $items;

	}

}