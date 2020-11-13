<?php
namespace EdgeCore\CPT\Shortcodes\ImageWithText;

use EdgeCore\Lib;

class ImageWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edge_image_with_text';

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
			'name'                      => esc_html__('Edge Image With Text', 'edge-core'),
			'base'                      => $this->getBase(),
			'category'                  => esc_html__('by EDGE', 'edge-core'),
			'icon' 						=> 'icon-wpb-image-with-text extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'		  => 'attach_image',
					'param_name'  => 'image',
					'heading'	  => esc_html__('Image', 'edge-core'),
					'description' => esc_html__('Select image from media library', 'edge-core')
				),
				array(
					'type'		  => 'textfield',
					'param_name'  => 'image_size',
					'heading'	  => esc_html__('Image Size', 'edge-core'),
					'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'edge-core')
				),
				array(
					'type'		  => 'dropdown',
					'param_name'  => 'enable_lightbox',
					'heading'	  => esc_html__('Enable Lightbox Functionality', 'edge-core'),
					'value'       => array_flip(adorn_edge_get_yes_no_select_array(false))
				),
                array(
                    'type'		  => 'dropdown',
                    'param_name'  => 'enable_image_shadow',
                    'heading'	  => esc_html__('Enable Image Shadow', 'edge-core'),
                    'value'       => array_flip(adorn_edge_get_yes_no_select_array(false))
                ),
                array(
                    'type'		  => 'dropdown',
                    'param_name'  => 'enable_image_border',
                    'heading'	  => esc_html__('Enable Image border', 'edge-core'),
                    'value'       => array_flip(adorn_edge_get_yes_no_select_array(false))
                ),
				array(
					'type'		  => 'textfield',
					'param_name'  => 'link',
					'heading'	  => esc_html__('Link', 'edge-core'),
				),
				array(
					'type'		  => 'textfield',
					'param_name'  => 'text_padding',
					'heading'	  => esc_html__('Text Holder Padding', 'edge-core'),
				),
				array(
                    'type'       => 'textfield',
                    'param_name' => 'title',
                    'heading'    => esc_html__('Title', 'edge-core')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'title_tag',
                    'heading'     => esc_html__('Title Tag', 'edge-core'),
                    'value'       => array_flip(adorn_edge_get_title_tag(true)),
                    'save_always' => true,
                    'dependency'  => array('element' => 'title', 'not_empty' => true)
                ),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_color',
					'heading'    => esc_html__('Title Color', 'edge-core'),
					'dependency' => array('element' => 'title', 'not_empty' => true)
				),
                array(
                    'type'       => 'textarea',
                    'param_name' => 'text',
                    'heading'    => esc_html__('Text', 'edge-core')
                ),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'text_color',
					'heading'    => esc_html__('Text Color', 'edge-core'),
					'dependency' => array('element' => 'text', 'not_empty' => true)
				)
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
			'image'			        => '',
			'image_size'	        => 'full',
			'enable_lightbox'       => 'no',
			'text_padding'          => '',
			'link'                  => '',
			'title'			        => '',
			'title_tag'	 	        => 'h4',
			'title_color'           => '',
			'text'			        => '',
			'text_color'            => '',
            'enable_image_shadow'   => '',
            'enable_image_border'   => ''
		);

		$params = shortcode_atts($args, $atts);
		$html = '';
		
		$params['image'] = $this->getImage($params);
        $params['image_border'] = $this->getImageBorder($params);
        $params['image_shadow'] = $this->getImageShadow($params);
		$params['image_size'] = $this->getImageSize($params['image_size']);
		$params['enable_lightbox'] = ($params['enable_lightbox'] === 'yes') ? true : false;
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['text_styles'] = $this->getTextStyles($params);
		$params['text_holder_styles'] = $this->getTextHolderStyles($params);

		if(count($params['image'])){
			$html .= edge_core_get_shortcode_module_template_part('templates/image-with-text', 'image-with-text', '', $params);
		}

		return $html;
	}

    private function getImageBorder($params) {
        $imageBorder ='';

        if ($params['enable_image_border']==='yes') {
            $imageBorder = 'border_enabled ';
        }

        return $imageBorder;
    }

    private function getImageShadow($params) {
        $imageShadow = array();

        if ($params['enable_image_shadow']==='yes') {
            $imageShadow= 'shadow_enabled';
        }

        return $imageShadow;
    }

	/**
	 * Return image for shortcode
	 *
	 * @param $params
	 * @return array
	 */
	private function getImage($params) {
        $image = array();

        if (!empty($params['image'])) {
            $id = $params['image'];

            $image['image_id'] = $id;
            $image_original = wp_get_attachment_image_src($id, 'full');
            $image['url'] = $image_original[0];
	        $image['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);
        }

		return $image;
	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {
		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $image_size;
		} elseif(!empty($matches[0])) {
			return array(
					$matches[0][0],
					$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
	
	private function getTitleStyles($params) {
		$styles = array();
		
		if (!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}
		
		return implode(';', $styles);
	}
	
	private function getTextStyles($params) {
		$styles = array();
		
		if (!empty($params['text_color'])) {
			$styles[] = 'color: '.$params['text_color'];
		}
		
		return implode(';', $styles);
	}
	private function getTextHolderStyles($params) {
		$styles = array();

		if (!empty($params['text_padding'])) {
			$styles[] = 'padding: '.$params['text_padding'];
		}

		return implode(';', $styles);
	}
}