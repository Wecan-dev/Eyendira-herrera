<?php
namespace EdgeCore\CPT\Shortcodes\ProductCategories;

use EdgeCore\Lib;

class ProductCategories implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_product_categories';
		
		add_action('vc_before_init', array($this,'vcMap'));

		//Portfolio category filter
		add_filter( 'vc_autocomplete_edge_product_categories_category_callback', array( &$this, 'productCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio category render
		add_filter( 'vc_autocomplete_edge_product_categories_category_render', array( &$this, 'productCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Product Categories', 'adorn'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-categories extended-custom-icon',
			'category' => esc_html__('by EDGE', 'adorn'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type' => 'textfield',
						'param_name' => 'number_of_posts',
						'heading' => esc_html__('Number of Posts', 'adorn')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'number_of_columns',
                        'heading'    => esc_html__('Number of Columns', 'adorn'),
                        'value'      => array(
							esc_html__('Two', 'adorn')   => '2',
							esc_html__('Three', 'adorn') => '3',
							esc_html__('Four', 'adorn')  => '4'
                        ),
                        'save_always' => true
                    ),
				array(
					'type'        => 'autocomplete',
					'param_name'  => 'category',
					'heading'     => esc_html__( 'Show Only Categories with Listed IDs', 'adorn' ),
					'settings'    => array(
						'multiple'      => true,
						'sortable'      => true,
						'unique_values' => true
					),
					'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'adorn' )
				),
                array(
					'type'       => 'dropdown',
					'param_name' => 'space_between_items',
					'heading'    => esc_html__('Space Between Items', 'adorn'),
					'value'      => array(
						esc_html__('Normal', 'adorn')   => 'normal',
						esc_html__('Large', 'adorn')    => 'large',
						esc_html__('Small', 'adorn')    => 'small',
						esc_html__('Tiny', 'adorn')     => 'tiny',
						esc_html__('No Space', 'adorn') => 'no'
					),
					'save_always' => true
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'content_position',
					'heading'    => esc_html__('Content Position', 'adorn'),
					'value'      => array(
						esc_html__('Top', 'adorn')   => 'top',
						esc_html__('Bottom', 'adorn')    => 'bottom',
					),
					'save_always' => true
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'hover_type',
					'heading'    => esc_html__('Hover Type', 'adorn'),
					'value'      => array(
						esc_html__('Shrink Zoom', 'adorn')   => 'shrink',
						esc_html__('Regular Zoom', 'adorn')    => 'regular',
					),
					'save_always' => true
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'parallax_items',
					'heading'    => esc_html__('Enable Parallax Items', 'adorn'),
					'value'      => array(
						esc_html__('No', 'adorn')    => '',
						esc_html__('Yes', 'adorn')   => 'yes',
					),
					'save_always' => true,
					'description' => esc_html__( 'If set to yes, parallax effect will be triggered only on non-touch devices.', 'adorn' )
				),
				array(
					'type'        => 'textfield',
					'param_name' => 'y_axis_translation',
					'heading'    	=> esc_html__('Y Axis Translation', 'adorn'),
					'value'      	=> esc_html__('0', 'adorn'),
					'save_always' => true,
					'dependency'  => array('element' => 'parallax_items', 'value' => array('yes')),
					'description' => esc_html__( 'Maximum movement in pixels. Negative value changes parallax direction.', 'adorn' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'enable_button',
					'heading'    => esc_html__('Enable Button', 'adorn'),
					'value'      => adorn_edge_get_yes_no_select_array(),
					'save_always' => true
				)

				)
		) );
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number_of_posts'         	=> '',
			'number_of_columns'       	=> '',
			'category'                	=> '',
			'space_between_items'     	=> '',
			'content_position'        	=> 'no',
			'hover_type'				=> 'shrink',
			'parallax_items'			=> 'no',
			'y_axis_translation'		=> '0',
			'enable_button'           	=> 'no',
        );

		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$results = $this->getCategories($params);
		$params['query_result'] = $this->getOrderedItems($results);
		$params['holder_clases'] = $this->getHolderClasses($params);
		$params['holder_data'] = $this->getHolderDataAttr($params);
		$params['this_object'] = $this;

		$html = adorn_edge_get_woo_shortcode_module_template_part('templates/holder', 'product-categories', '', $params);
		
		return $html;
	}

	private function getCategories($params){
		$tax_args = array(
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC'
		);
		if(isset($params['category']) && $params['category'] !== ''){

			$cats = explode(',', $params['category']);
			$choosen_taxes = array();
			foreach ($cats as $cat_slug){
				$tax = get_term_by('slug', $cat_slug, 'product_cat');
				$choosen_taxes[] = $tax->term_id;
			};

			$tax_args['include'] = $choosen_taxes;
			$tax_args['number'] = count($cats);

		}else{
			$tax_args['number'] =  $params['number_of_posts'];
		}
		$taxes = get_terms('product_cat',$tax_args);

		if(! empty( $taxes ) && ! is_wp_error( $taxes ) ){
			return $taxes;
		}
		else{
			return array();
		}

		return array();

	}

	private function getOrderedItems($results){
		$order_array = array();
		if(is_array($results) && count($results)){

			foreach ($results as $result_key => $result){

				$order_meta = get_term_meta($result->term_id, 'category_masonry_order', true);

				$result->order = 999999;
				if(!empty($order_meta)){
					$result->order = (int)$order_meta;
				}

				//prepare merged array sorting(by featured order number)
				$order_array[$result_key] = (int)$result->order;
			}

		}


		//sort merged array
		array_multisort($order_array, SORT_ASC, $results);
		return $results;

	}

	    /**
     *
     * Returns array of holder data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderDataAttr($params) {
        $data = array();

        if($params['parallax_items'] !== ''){
			$data['data-y-axis-translation'] = $params['y_axis_translation'];
		}

        return $data;
    }

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getHolderClasses($params){
		$holderClasses = array();
		if($params['space_between_items'] !== ''){
			$holderClasses[] = 'edge-'.$params['space_between_items'].'-space';
		}

		if($params['hover_type'] !== ''){
			$holderClasses[] = 'edge-'.$params['hover_type'].'-zoom';
		}

		if($params['parallax_items'] !== ''){
			$holderClasses[] = 'edge-parallax-items';
		}

		$holderClasses[] = $this->getColumnNumberClass($params);
		
		return implode(' ', $holderClasses);
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
	        default:
		        $columnsNumber = 'edge-two-columns';
	        	break;
        }

        return $columnsNumber;
    }

	/**
	 * Filter product categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function productCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'product_cat' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'adorn' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find product category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function productCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get product category
			$product_category = get_term_by( 'slug', $query, 'product_cat' );
			if ( is_object( $product_category ) ) {

				$category_slug = $product_category->slug;
				$category_title = $product_category->name;

				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'adorn' ) . ': ' . $category_title;
				}

				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

}