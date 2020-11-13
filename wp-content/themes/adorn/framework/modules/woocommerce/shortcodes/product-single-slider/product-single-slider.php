<?php
namespace EdgeCore\CPT\Shortcodes\ProductSingleSlider;

use EdgeCore\Lib;

class ProductSingleSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_product_single_slider';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Product Slider', 'adorn'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-single-slider extended-custom-icon',
			'category' => esc_html__('by EDGE', 'adorn'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__('Number of Products', 'adorn')
					),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'slider_title',
                        'heading'     => esc_html__('Enter Slider Title', 'adorn')
                    ),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order_by',
						'heading'     => esc_html__('Order By', 'adorn'),
						'value'       => array_flip(adorn_edge_get_query_order_by_array()),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__('Order', 'adorn'),
						'value'       => array_flip(adorn_edge_get_query_order_array()),
						'save_always' => true
					),
					array(
	                    'type'       => 'dropdown',
	                    'param_name' => 'taxonomy_to_display',
	                    'heading'    => esc_html__('Choose Sorting Taxonomy', 'adorn'),
	                    'value'      => array(
							esc_html__('Category', 'adorn') => 'category',
							esc_html__('Tag', 'adorn')      => 'tag',
							esc_html__('Id', 'adorn')       => 'id'
	                    ),
	                    'description' => esc_html__('If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'adorn')
	                ),
	                array(
	                    'type'        => 'textfield',
	                    'param_name'  => 'taxonomy_values',
	                    'heading'     => esc_html__('Enter Taxonomy Values', 'adorn'),
	                    'description' => esc_html__('Separate values (category slugs, tags, or post IDs) with a comma', 'adorn')
	                ),
	                array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Image Proportions', 'adorn'),
						'param_name' => 'image_size',
						'value'      => array(
							esc_html__('Default', 'adorn')        => '',
							esc_html__('Original', 'adorn')       => 'full',
							esc_html__('Square', 'adorn')         => 'square',
							esc_html__('Landscape', 'adorn')      => 'landscape',
							esc_html__('Portrait', 'adorn')       => 'portrait',
							esc_html__('Medium', 'adorn')         => 'medium',
							esc_html__('Large', 'adorn')          => 'large',
							esc_html__('Shop Catalog', 'adorn')   => 'shop_catalog',
							esc_html__('Shop Single', 'adorn')    => 'shop_single',
							esc_html__('Shop Thumbnail', 'adorn') => 'shop_thumbnail'
						)
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'slider_loop',
						'heading'     => esc_html__('Enable Slider Loop', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'slider_autoplay',
						'heading'     => esc_html__('Enable Slider Autoplay', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'slider_speed',
						'heading'     => esc_html__('Slider Speed', 'adorn'),
						'description' => esc_html__('Default value is 5000 (ms)', 'adorn'),
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'slider_speed_animation',
						'heading'     => esc_html__('Slider Slide Animation', 'adorn'),
						'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'adorn'),
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'		  => 'dropdown',
						'param_name'  => 'slider_navigation',
						'heading'	  => esc_html__('Enable Slider Navigation Arrows', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'slider_navigation_skin',
						'heading'    => esc_html__('Slider Navigation Skin', 'adorn'),
						'value'      => array(
							esc_html__('Default', 'adorn') => 'default',
							esc_html__('Light', 'adorn')   => 'light'
						),
						'dependency'  => array('element' => 'slider_navigation', 'value' => array('yes')),
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'		  => 'dropdown',
						'param_name'  => 'slider_pagination',
						'heading'	  => esc_html__('Enable Slider Pagination', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'slider_pagination_skin',
						'heading'    => esc_html__('Slider Pagination Skin', 'adorn'),
						'value'      => array(
							esc_html__('Default', 'adorn') => 'default',
							esc_html__('Light', 'adorn')   => 'light'
						),
						'dependency'  => array('element' => 'slider_pagination', 'value' => array('yes')),
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'slider_pagination_pos',
						'heading'    => esc_html__('Slider Pagination Position', 'adorn'),
						'value'      => array(
							esc_html__('Inside Slider', 'adorn') => 'inside-slider',
                            esc_html__('Below Slider', 'adorn')  => 'bellow-slider'
						),
						'dependency'  => array('element' => 'slider_pagination', 'value' => array('yes')),
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'slider_pagination_numbers',
						'heading'    => esc_html__('Slider Pagination Numbers', 'adorn'),
						'value'      => array(
							esc_html__('Yes', 'adorn') => 'yes',
							esc_html__('No', 'adorn')  => 'no'
						),
						'save_always'   => true,
						'dependency'  => array('element' => 'slider_pagination', 'value' => array('yes')),
						'group'       => esc_html__('Slider Settings', 'adorn')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_title',
						'heading'     => esc_html__('Display Title', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'adorn')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_tag',
						'heading'     => esc_html__('Title Tag', 'adorn'),
						'value'       => array_flip(adorn_edge_get_title_tag(true)),
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'adorn')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_transform',
						'heading'     => esc_html__('Title Text Transform', 'adorn'),
						'value'       => array_flip(adorn_edge_get_text_transform_array(true)),
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'adorn')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_category',
						'heading'     => esc_html__('Display Category', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'adorn')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_excerpt',
						'heading'     => esc_html__('Display Excerpt', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'adorn')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__('Excerpt Length', 'adorn'),
						'description' => esc_html__('Number of characters', 'adorn'),
						'dependency'  => array('element' => 'display_excerpt', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'adorn')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'product_info_skin',
                        'heading'    => esc_html__('Product Info Skin', 'adorn'),
                        'value'      => array(
                            esc_html__('Default', 'adorn') => 'default',
                            esc_html__('Dark', 'adorn')   => 'dark',
                            esc_html__('Light', 'adorn')   => 'light'
                        ),
                        'group'       => esc_html__('Product Info Style', 'adorn')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'product_info_type',
                        'heading'    => esc_html__('Product Info type', 'adorn'),
                        'value'      => array(
                            esc_html__('Left', 'adorn') => 'left',
                            esc_html__('Right', 'adorn')   => 'right'
                        ),
                        'group'       => esc_html__('Product Info Style', 'adorn')
                    ),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_price',
						'heading'     => esc_html__('Display Price', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'adorn')
					),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'display_button',
                        'heading'     => esc_html__('Display Shop Now Button', 'adorn'),
                        'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, false)),
                        'group'	      => esc_html__('Product Info', 'adorn')
                    )
				)
		) );

	}
	public function render($atts, $content = null) {
		$default_atts = array(
            'number_of_posts' 		  => '8',
            'order_by' 				  => 'date',
            'order' 				  => 'ASC',
            'taxonomy_to_display' 	  => 'category',
            'slider_pagination_numbers' => '',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
			'slider_loop'		      => 'yes',
			'slider_autoplay'		  => 'yes',
			'slider_speed'		      => '5000',
			'slider_speed_animation'  => '600',
			'slider_navigation'	      => 'no',
			'slider_navigation_skin'  => 'default',
			'slider_pagination'	      => 'yes',
			'slider_pagination_skin'  => 'default',
			'slider_pagination_pos'   => 'inside-slider',
            'display_title' 		  => 'yes',
            'title_tag'				  => 'h4',
            'title_transform'		  => '',
			'display_category'        => 'yes',
			'display_excerpt'		  => 'no',
			'excerpt_length' 		  => '20',
			'display_price' 		  => 'yes',
            'slider_title'             => '',
            'product_info_skin'       => 'default',
            'product_info_type'       => 'left',
            'display_button'          => 'no'
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['holder_data'] = $this->getProductSingleSliderDataAttributes($params);
		$params['class_name'] = 'pls';
        $params['productTextClasses']= $this->getProductTextClasses($params);
		
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;
		$params['this_object'] = $this;

		$html = adorn_edge_get_woo_shortcode_module_template_part('templates/product-single-slider', 'product-single-slider', '', $params);
		
		return $html;
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getHolderClasses($params){
		$holderClasses = '';

        $holderClasses = $this->getSliderClasses($params);
		
		return $holderClasses;
	}
	
	/**
	 * Generates slider classes for product single holder
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getSliderClasses($params){
		$sliderClasses = '';

		if(!empty($params['slider_navigation_skin'])) {
			$sliderClasses .= ' edge-pls-nav-'.$params['slider_navigation_skin'].'-skin';
		}

		if(!empty($params['slider_pagination_pos'])) {
			$sliderClasses .= ' edge-pls-pag-'.$params['slider_pagination_pos'];
		}

		if(!empty($params['slider_pagination_skin'])) {
			$sliderClasses .= ' edge-pls-pag-'.$params['slider_pagination_skin'].'-skin';
		}
		if($params['slider_pagination_numbers'] === 'yes'){
			$sliderClasses .= ' edge-pls-pag-with-numbers';
		}

		return $sliderClasses;
	}

	public function getArticleClasses($id){

		$classes = array();
		$skin = get_post_meta($id, 'product_slider_skin', true);
		$classes['skin'] = 'edge-product-slider-light-skin';
		if(isset($skin) && $skin !== ''){
			$classes['skin'] = 'edge-product-slider-'.esc_attr($skin).'-skin';
		}
		return implode(' ', $classes);

	}

    /**
     * Generates classes for product single text holder
     *
     * @param $params
     *
     * @return string
     */
    private function getProductTextClasses($params){
        $productTextClasses = '';

        if(!empty($params['product_info_skin'])) {
            $productTextClasses .= ' edge-pls-text-'.$params['product_info_skin'].'-skin';
        }
        if(!empty($params['product_info_type'])) {
            $productTextClasses .= ' edge-pls-text-'.$params['product_info_type'].'-type';
        }

        return $productTextClasses;
    }
	
    /**
     * Return all data that product single slider needs
     *
     * @param $params
     * @return array
     */
    private function getProductSingleSliderDataAttributes($params) {
	    $slider_data = array();
	
	    $slider_data['data-number-of-items']        = '1';
	    $slider_data['data-enable-loop']            = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
	    $slider_data['data-enable-autoplay']        = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
	    $slider_data['data-slider-speed']           = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
	    $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
	    $slider_data['data-enable-navigation']      = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
	    $slider_data['data-enable-pagination']      = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';
	    $slider_data['data-enable-dots-data']       = $params['slider_pagination_numbers'] ? $params['slider_pagination_numbers'] : '';

	    return $slider_data;
    }

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateProductQueryArray($params){
		$queryArray = array(
			'post_status' => 'publish',
			'post_type' => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $params['number_of_posts'],
			'orderby' => $params['order_by'],
			'order' => $params['order']
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }

        return $queryArray;
	}
	
	/**
	 * Return Style for Title
	 *
	 * @param $params
	 * @return string
	 */
	public function getTitleStyles($params) {
		$styles = array();
		
		if (!empty($params['title_transform'])) {
			$styles[] = 'text-transform: '.$params['title_transform'];
		}
		
		return implode(';', $styles);
	}
}