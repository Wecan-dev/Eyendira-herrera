<?php
namespace EdgeCore\CPT\Shortcodes\ProductList;

use EdgeCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_product_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Product List', 'adorn'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-list extended-custom-icon',
			'category' => esc_html__('by EDGE', 'adorn'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'       => 'dropdown',
						'param_name' => 'type',
						'heading'    => esc_html__('Type', 'adorn'),
						'value'      => array(
							esc_html__('Standard', 'adorn') => 'standard',
							esc_html__('Masonry', 'adorn')  => 'masonry'
						),
						'admin_label' => true
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'info_position',
						'heading'    => esc_html__('Product Info Position', 'adorn'),
						'value'      => array(
							esc_html__('Info On Image Hover', 'adorn') => 'info-on-image',
							esc_html__('Info Below Image', 'adorn')    => 'info-below-image'
						),
						'admin_label' => true
					),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'crop_image',
                        'heading'     => esc_html__('Crop On Hover', 'adorn'),
                        'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, false)),
                        'dependency'  => array('element' => 'info_position', 'value' => array('info-on-image')),
                    ),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__('Number of Products', 'adorn')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'number_of_columns',
                        'heading'    => esc_html__('Number of Columns', 'adorn'),
                        'value'      => array(
							esc_html__('One', 'adorn')   => '1',
							esc_html__('Two', 'adorn')   => '2',
							esc_html__('Three', 'adorn') => '3',
							esc_html__('Four', 'adorn')  => '4',
							esc_html__('Five', 'adorn')  => '5',
							esc_html__('Six', 'adorn')   => '6'
                        ),
                        'save_always' => true
                    ),
                    array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_items',
						'heading'    => esc_html__('Space Between Items', 'adorn'),
						'value'      => array(
							esc_html__('Large', 'adorn')    => 'large',
							esc_html__('Normal', 'adorn')   => 'normal',
							esc_html__('Small', 'adorn')    => 'small',
							esc_html__('Tiny', 'adorn')     => 'tiny',
							esc_html__('No Space', 'adorn') => 'no'
						),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'show_ordering_filter',
						'heading'     => esc_html__('Show Ordering Filter', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, false)),
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'price_range',
						'heading'    => esc_html__('Price range for pricing filter', 'adorn'),
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('yes')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'orderby',
						'heading'     => esc_html__('Order By', 'adorn'),
						'value'       => array_flip(adorn_edge_get_query_order_by_array()),
						'save_always' => true,
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__('Order', 'adorn'),
						'value'       => array_flip(adorn_edge_get_query_order_array()),
						'save_always' => true,
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'show_category_filter',
						'heading'     => esc_html__('Show Category Filter', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, false)),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'category_values',
						'heading'     => esc_html__('Enter Category Values', 'adorn'),
						'description' => esc_html__('Separate values (category slugs) with a comma', 'adorn'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
					),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'show_all_item_in_filter',
					'heading'     => esc_html__('Show "All" Item in Filter', 'adorn'),
					'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
					'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
				),
					array(
	                    'type'       => 'dropdown',
	                    'param_name' => 'taxonomy_to_display',
	                    'heading'    => esc_html__('Choose Sorting Taxonomy', 'adorn'),
	                    'value' => array(
							esc_html__('Category', 'adorn') => 'category',
							esc_html__('Tag', 'adorn')      => 'tag',
							esc_html__('Id', 'adorn')       => 'id'
	                    ),
	                    'description' => esc_html__('If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'adorn'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
	                ),
	                array(
	                    'type'        => 'textfield',
	                    'param_name'  => 'taxonomy_values',
	                    'heading'     => esc_html__('Enter Taxonomy Values', 'adorn'),
	                    'description' => esc_html__('Separate values (category slugs, tags, or post IDs) with a comma', 'adorn'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
	                ),
	                array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__('Image Proportions', 'adorn'),
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
						'param_name'  => 'display_title',
						'heading'     => esc_html__('Display Title', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'adorn')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'product_info_skin',
						'heading'    => esc_html__('Product Info Skin', 'adorn'),
						'value'      => array(
							esc_html__('Default', 'adorn')  => 'default',
							esc_html__('Light', 'adorn') => 'light',
							esc_html__('Dark', 'adorn') => 'dark'
						),
						'group'	      => esc_html__('Product Info Style', 'adorn')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'product_info_hover_skin',
                        'heading'    => esc_html__('Product Info Hover Background Skin', 'adorn'),
                        'value'      => array(
                            esc_html__('Light', 'adorn') => 'light',
                            esc_html__('Dark', 'adorn') => 'dark'
                        ),
                        'dependency'  => array('element' => 'info_position', 'value' => array('info-on-image')),
                        'group'	      => esc_html__('Product Info Style', 'adorn')
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
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'adorn'),
                        'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_price',
						'heading'     => esc_html__('Display Price', 'adorn'),
						'value'       => array_flip(adorn_edge_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'adorn')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'info_bottom_text_align',
						'heading'    => esc_html__('Product Info Text Alignment', 'adorn'),
						'value'      => array(
							esc_html__('Default', 'adorn')  => '',
							esc_html__('Left', 'adorn') => 'left',
							esc_html__('Center', 'adorn') => 'center',
							esc_html__('Right', 'adorn') => 'right'
						),
						'dependency'  => array('element' => 'info_position', 'value' => array('info-below-image')),
						'group'	      => esc_html__('Product Info Style', 'adorn')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'info_bottom_margin',
						'heading'    => esc_html__('Product Info Bottom Margin (px)', 'adorn'),
						'dependency' => array('element' => 'info_position', 'value' => array('info-below-image')),
						'group'	     => esc_html__('Product Info Style', 'adorn')
					)
				)
		) );
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'type'					  => 'standard',
			'info_position'			  => 'info-on-image',
            'number_of_posts' 		  => '8',
            'number_of_columns' 	  => '4',
            'space_between_items'	  => '',
            'show_ordering_filter'	  => 'no',
            'price_range'	  		  => '',
            'orderby' 				  => 'date',
            'order' 				  => 'ASC',
            'show_category_filter' 	  => 'no',
            'category_values' 	  	  => '',
			'show_all_item_in_filter' => 'yes',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
            'display_title' 		  => 'yes',
			'product_info_skin'       => '',
            'product_info_hover_skin' => '',
            'title_tag'				  => 'h5',
            'title_transform'		  => '',
			'display_category'        => 'no',
            'display_excerpt' 		  => 'no',
            'excerpt_length' 		  => '20',
			'display_rating' 		  => 'no',
			'display_price' 		  => 'yes',
			'info_bottom_text_align'  => '',
            'info_bottom_margin' 	  => '',
            'crop_image'              => ''
        );

		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['class_name'] = 'pli';
		$params['type'] = !empty($params['type']) ? $params['type'] : $default_atts['type'];
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['text_wrapper_styles'] = $this->getTextWrapperStyles($params);
		$params['categories_filter_list'] = $this->getProductCategoriesList($params);
		$params['ordering_filter_list'] = $this->getProductOrderingList($params);
		$params['pricing_filter_list'] = $this->getProductPricingList($params);
		$params['holder_data'] = $this->getHolderData($params);
		$params['crop_image'] = $this->getCropImage($params);

		$params['category'] = ''; //used for ajax calling in category filter
		$params['meta_key'] = ''; //used for ajax calling in category filter
		$params['min_price'] = ''; //used for ajax calling in ordering filter
		$params['max_price'] = ''; //used for ajax calling in ordering filter

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$html = adorn_edge_get_woo_shortcode_module_template_part('templates/product-list-'.$params['type'], 'product-list', '', $params);
		
		return $html;
	}

	private function getCropImage($params){
        $style = '';

        if ($params['crop_image'] === 'yes'){
            $style = 'crop-image';
        }

        return $style;
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

		$productListType = !empty($params['type']) ? 'edge-'.$params['type'].'-layout' : 'edge-standard-layout';

        $columnsSpace = !empty($params['space_between_items']) ? 'edge-'.$params['space_between_items'].'-space' : 'edge-normal-space';

        $columnNumber = $this->getColumnNumberClass($params);

		$infoPosition = !empty($params['info_position']) ? 'edge-'.$params['info_position'] : 'edge-info-on-image';
		
		$productInfoClasses = !empty($params['product_info_skin']) ? 'edge-product-info-'.$params['product_info_skin'] : '';

        $productInfoHoverClasses = !empty($params['product_info_hover_skin']) ? 'edge-product-info-hover-'.$params['product_info_hover_skin'] : '';

        $holderClasses .= $productListType . ' ' . $columnsSpace . ' ' . $columnNumber . ' ' . $infoPosition . ' ' . $productInfoClasses . ' ' . $productInfoHoverClasses;
		
		return $holderClasses;
	}

    /**
     * Generates columns number classes for product list holder
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params){

        $columns = $params['number_of_columns'];

        switch ($columns) {
            case 1:
                $columnsNumber = 'edge-one-column';
                break;
            case 2:
                $columnsNumber = 'edge-two-columns';
                break;
            case 3:
                $columnsNumber = 'edge-three-columns';
                break;
            case 4:
                $columnsNumber = 'edge-four-columns';
                break;
            case 5:
                $columnsNumber = 'edge-five-columns';
                break;
            case 6:
                $columnsNumber = 'edge-six-columns';
                break;        
            default:
                $columnsNumber = 'edge-four-columns';
                break;
        }

        return $columnsNumber;
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
			'orderby' => $params['orderby'],
			'order' => $params['order']
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' && $params['show_category_filter'] == 'no') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' && $params['show_category_filter'] == 'no') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' && $params['show_category_filter'] == 'no') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }


		//used for ajax calling in ordering filter
        if($params['show_ordering_filter'] == 'yes') {
			unset($queryArray['orderby'], $queryArray['order']);

			if ($params['meta_key'] !== ''){
				$queryArray['orderby'] = $params['orderby'];
				$queryArray['order'] = $params['order'];
				$queryArray['meta_key'] = $params['meta_key'];
			}

			if($params['min_price'] !== '' || $params['max_price'] !== ''){
				$queryArray['meta_query'] = array(
					array(
						'key' => '_price',
						'value' => array($params['min_price'], $params['max_price']),
						'compare' => 'BETWEEN',
						'type' => 'NUMERIC'
					),
				);
			}
		}

        //used for ajax calling in category filter
        if($params['show_category_filter'] == 'yes'){
        	if($params['category_values'] !== '' && $params['category'] == '') {
				$queryArray['product_cat'] = $params['category_values'];
			}else {
				$queryArray['product_cat'] = $params['category'];
			}
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

    /**
     * Return Style for Text Wrapper Holder
     *
     * @param $params
     * @return string
     */
	public function getTextWrapperStyles($params) {
	    $styles = array();
	
	    if (!empty($params['info_bottom_text_align'])) {
		    $styles[] = 'text-align: '.$params['info_bottom_text_align'];
	    }
		
        if ($params['info_bottom_margin'] !== '') {
	        $styles[] = 'margin-bottom: '.adorn_edge_filter_px($params['info_bottom_margin']).'px';
        }

		return implode(';', $styles);
    }

	/**
	 * Return product categories
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductCategoriesList($params) {
		$category_html = '';

		if($params['show_category_filter'] == 'yes') {
			$taxonomy = 'product_cat';
			$orderby = 'name';
			$show_count = 0;      // 1 for yes, 0 for no
			$pad_counts = 0;      // 1 for yes, 0 for no
			$hierarchical = 1;      // 1 for yes, 0 for no
			$title = '';
			$empty = 0;
			$parent = 0;

			$args = array(
				'taxonomy' => $taxonomy,
				'orderby' => $orderby,
				'show_count' => $show_count,
				'pad_counts' => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li' => $title,
				'hide_empty' => $empty,
				'parent' => $parent
			);

			$all_categories_string = '';
			if($params['category_values'] == ''){
				$all_categories = get_categories($args);

			}else{
				$all_categories = array();
				$categories = explode(',',$params['category_values']);
				foreach ($categories as $cat){
					$all_categories[] = get_term_by( 'slug', $cat, 'product_cat' );
					$all_categories_string .= $cat.',';
				}
			}

			if($params['show_all_item_in_filter'] == 'yes') {
				$category_html .= '<li><a class="edge-no-smooth-transitions active" data-category="' . $all_categories_string . '" href="#">' . esc_html__('All', 'adorn') . '</a></li>';
			}
			foreach ($all_categories as $cat) {
				$category_html .= '<li><a class="edge-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a></li>';

				$termchildren = get_term_children( $cat->term_id, 'product_cat' );

				if(!empty($termchildren)){
					foreach ( $termchildren as $child ) {
						$cat = get_term_by( 'id', $child, 'product_cat' );
						$category_html .= '<li><a class="edge-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($child, 'product_cat') . '">' . $cat->name . '</a></li>';
					}
				}
			}
		}

		return $category_html;
	}

	/**
	 * Return products sort by
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductOrderingList($params) {
		$sorting_list_html = '';

		if($params['show_ordering_filter'] == 'yes') {
			$orderby_options = apply_filters('woocommerce_catalog_orderby', array(
				'menu_order' => esc_html__('Default', 'adorn'),
				'popularity' => esc_html__('Popularity', 'adorn'),
				'rating' => esc_html__('Average rating', 'adorn'),
				'newness' => esc_html__('Newness', 'adorn'),
				'price' => esc_html__('Price: Low to High', 'adorn'),
				'price-desc' => esc_html__('Price: High to Low', 'adorn')
			));

			if (get_option('woocommerce_enable_review_rating') === 'no') {
				unset($orderby_options['rating']);
			}

			foreach ($orderby_options as $key => $value) {
				$sorting_list_html .= '<li><a class="edge-no-smooth-transitions" data-ordering="'. $key .'" href="#">'. $value .'</a></li>';
			}
		}

		return $sorting_list_html;
	}

	/**
	 * Return products sort by
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductPricingList($params) {
		$pricing_list_html = '';

		if($params['show_ordering_filter'] == 'yes') {
			$range = $params['price_range'] !== '' ? $params['price_range'] : 10;
			$value = 0;

			$pricing_list_html .= '<li><a data-minPrice="" data-maxPrice="" href="#">' . esc_html__('All', 'adorn') . '</a></li>';
			for ($i = 1; $i <= 5; $i++){
				if($i !== 5){
					$pricing_list_html .= '<li><a data-minPrice="'. $value .'" data-maxPrice="'. ($value+$range) .'" href="#">'. get_woocommerce_currency_symbol().$value .'-'.get_woocommerce_currency_symbol().($value+$range). '</a></li>';

				}else{
					$pricing_list_html .= '<li><a data-minPrice="'. ($value) .'" data-maxPrice="'.(100000000000).'" href="#">'. ($value).get_woocommerce_currency_symbol(). '+</a></li>';
				}

				$value += $range;
			}

		}

		return $pricing_list_html;
	}

	/**
	 * Generates data attributes array
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderData($params){
		$dataString = '';
		unset($params['categories_filter_list'], $params['ordering_filter_list'], $params['pricing_filter_list'] );
		foreach ($params as $key => $value) {
			if($value !== '') {
				$new_key = str_replace( '_', '-', $key );

				$dataString .= ' data-'.$new_key.'="'.esc_attr($value).'"';
			}
		}

		return $dataString;
	}
}