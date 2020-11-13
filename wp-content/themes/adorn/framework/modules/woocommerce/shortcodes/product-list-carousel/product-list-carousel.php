<?php
namespace EdgeCore\CPT\Shortcodes\ProductListCarousel;

use EdgeCore\Lib;

class ProductListCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_product_list_carousel';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Product List - Carousel', 'adorn'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-list-carousel extended-custom-icon',
			'category' => esc_html__('by EDGE', 'adorn'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__('Number of Products', 'adorn')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_items',
						'heading'    => esc_html__('Space Between Items', 'adorn'),
						'value'      => array(
							esc_html__('Normal', 'adorn')   => 'normal',
							esc_html__('Small', 'adorn')    => 'small',
							esc_html__('Tiny', 'adorn')     => 'tiny',
							esc_html__('No Space', 'adorn') => 'no'
						),
						'save_always' => true,
					),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'carousel_title',
                        'heading'     => esc_html__('Enter Carousel Title', 'adorn')
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
						'type'       => 'dropdown',
						'param_name' => 'number_of_visible_items',
						'heading'    => esc_html__('Number Of Visible Items', 'adorn'),
						'value'      => array(
							esc_html__('One', 'adorn')   => '1',
							esc_html__('Two', 'adorn')   => '2',
							esc_html__('Three', 'adorn') => '3',
							esc_html__('Four', 'adorn')  => '4',
							esc_html__('Five', 'adorn')  => '5',
							esc_html__('Six', 'adorn')   => '6'
						),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'adorn')
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
							esc_html__('Below Carousel', 'adorn')  => 'bellow-slider',
							esc_html__('Inside Carousel', 'adorn') => 'inside-slider'
						),
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
						'type'        => 'dropdown',
						'param_name'  => 'display_rating',
						'heading'     => esc_html__('Display Rating', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'adorn')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_price',
						'heading'     => esc_html__('Display Price', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'adorn')
					)
				)
		) );

	}
	public function render($atts, $content = null) {
		$default_atts = array(
            'number_of_posts' 		  => '8',
            'space_between_items'	  => '',
            'order_by' 				  => 'date',
            'order' 				  => 'ASC',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
			'number_of_visible_items' => '1',
			'slider_loop'		      => 'yes',
			'slider_autoplay'		  => 'yes',
			'slider_speed'		      => '5000',
			'slider_speed_animation'  => '600',
			'slider_navigation'	      => 'yes',
			'slider_navigation_skin'  => 'default',
			'slider_pagination'	      => 'yes',
			'slider_pagination_skin'  => 'default',
			'slider_pagination_pos'   => 'bellow-slider',
            'display_title' 		  => 'yes',
            'title_tag'				  => 'h4',
            'title_transform'		  => '',
			'display_category'        => 'no',
			'display_excerpt'		  => 'no',
			'excerpt_length' 		  => '20',
			'display_rating' 		  => 'no',
			'display_price' 		  => 'yes',
            'display_button' 		  => 'yes',
            'carousel_title'          => ''
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['holder_data'] = $this->getProductListCarouselDataAttributes($params);
		$params['class_name'] = 'plc';
		
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$html = adorn_edge_get_woo_shortcode_module_template_part('templates/product-list-carousel', 'product-list-carousel', '', $params);
		
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
		
		$columnsSpace = !empty($params['space_between_items']) ? 'edge-'.$params['space_between_items'].'-space' : 'edge-normal-space';
		
		$carouselClasses = $this->getCarouselClasses($params);
		
		$holderClasses .= ' '. $columnsSpace . ' ' . $carouselClasses;
		
		return $holderClasses;
	}
	
	/**
	 * Generates carousel classes for product list holder
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getCarouselClasses($params){
		$carouselClasses = '';

		if(!empty($params['slider_navigation_skin'])) {
			$carouselClasses .= ' edge-plc-nav-'.$params['slider_navigation_skin'].'-skin';
		}

		if(!empty($params['slider_pagination_pos'])) {
			$carouselClasses .= ' edge-plc-pag-'.$params['slider_pagination_pos'];
		}

		if(!empty($params['slider_pagination_skin'])) {
			$carouselClasses .= ' edge-plc-pag-'.$params['slider_pagination_skin'].'-skin';
		}

		return $carouselClasses;
	}
	
    /**
     * Return all data that product list carousel needs
     *
     * @param $params
     * @return array
     */
    private function getProductListCarouselDataAttributes($params) {
	    $slider_data = array();
	
	    $slider_data['data-number-of-items']        = !empty($params['number_of_visible_items']) ? $params['number_of_visible_items'] : '1';
	    $slider_data['data-enable-loop']            = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
	    $slider_data['data-enable-autoplay']        = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
	    $slider_data['data-slider-speed']           = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
	    $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
	    $slider_data['data-enable-navigation']      = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
	    $slider_data['data-enable-pagination']      = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';
	
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