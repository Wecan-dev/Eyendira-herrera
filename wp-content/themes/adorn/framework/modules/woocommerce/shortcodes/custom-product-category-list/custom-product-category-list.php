<?php
namespace EdgeCore\CPT\Shortcodes\CustomProductCategoriesList;

use EdgeCore\Lib;

class CustomProductCategoriesList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_custom_prod_cat_list';
		
		add_action('vc_before_init', array($this,'vcMap'));

		//Portfolio category filter
		add_filter( 'vc_autocomplete_edge_custom_prod_cat_list_category_callback', array( &$this, 'productCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio category render
		add_filter( 'vc_autocomplete_edge_custom_prod_cat_list_category_render', array( &$this, 'productCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio selected projects filter
		add_filter( 'vc_autocomplete_edge_custom_prod_cat_list_selected_projects_callback', array( &$this, 'productIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio selected projects render
		add_filter( 'vc_autocomplete_edge_custom_prod_cat_list_selected_projects_render', array( &$this, 'productIdAutocompleteRender', ), 10, 1 ); // Render exact product. Must return an array (label,value)
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Custom Product and Category List', 'adorn'),
			'base' => $this->base,
			'icon' => 'icon-wpb-edge-custom-product-categories-list extended-custom-icon',
			'category' => esc_html__('by EDGE', 'adorn'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'        => 'autocomplete',
						'param_name'  => 'selected_projects',
						'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'adorn' ),
						'settings'    => array(
							'multiple'      => true,
							'sortable'      => true,
							'unique_values' => true
						),
						'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'adorn' )
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
                        'param_name' => 'number_of_columns',
                        'heading'    => esc_html__('Number of Columns', 'adorn'),
                        'value'      => array(
							esc_html__('Two', 'adorn')   => '2',
							esc_html__('Three', 'adorn') => '3',
							esc_html__('Four', 'adorn')  => '4'
                        ),
                        'save_always' => true
                    )
				)
		) );
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'selected_projects'       => '',
			'category'                => '',
			'number_of_columns'       => ''
        );

		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$category_array = $this->getCategories($params);
		$posts_array = $this->getPosts($params);
		$items_to_show = array();


		if(count($category_array)){
			foreach ($category_array as $cat){
				$items_to_show['cat-'.$cat->term_id] = $this->getCategoryItem($cat->term_id, $cat->name, $cat->slug);
			}
		}

		if(count($posts_array)){
			foreach ($posts_array as $post){
				$items_to_show['post-'.$post->ID] = $this->getPostItem($post->ID);
			}
		}


		//prepare merged array sorting(by featured order number)
		$order_array = array();
		foreach ($items_to_show as $key => $item){
			$order_array[$key] = (int)$item['order'];
		}

		//sort merged array
		array_multisort($order_array, SORT_ASC, $items_to_show);

		$params['query_result'] = $items_to_show;
		$params['holder_clases'] = $this->getHolderClasses($params);
		$params['this_object'] = $this;

		$html = adorn_edge_get_woo_shortcode_module_template_part('templates/holder', 'custom-product-category-list', '', $params);
		
		return $html;
	}

	private function getCategories($params){

		if(isset($params['category']) && $params['category'] !== ''){
			$tax_args = array(
				'hide_empty' => false,
				'orderby' => 'name',
				'order' => 'ASC'
			);

			$cats = explode(',', $params['category']);
			$choosen_taxes = array();
			foreach ($cats as $cat_slug){
				$tax = get_term_by('slug', $cat_slug, 'product_cat');
				if($tax){
					$choosen_taxes[] = $tax->term_id;
				}
			};

			$tax_args['include'] = $choosen_taxes;
			$tax_args['number'] = count($cats);
			$taxes = get_terms('product_cat',$tax_args);

			if(is_array($taxes) && count($taxes)  && ! is_wp_error( $taxes ) ){
				return $taxes;
			}
			else{
				return array();
			}
		}

		return array();

	}

	private function getPosts($params){

		if(isset($params['selected_projects']) && $params['selected_projects'] !== ''){

			$post_args = array(
				'post_type'        => 'product',
				'post_status'      => 'publish'
			);

			$posts = explode(',', $params['selected_projects']);

			$post_args['include'] = $params['selected_projects'];
			$post_args['posts_per_page'] = count($posts);

			$posts = get_posts($post_args);

			if(is_array($posts) && count($posts)){
				return $posts;
			}
			else{
				return array();
			}
		}

		return array();

	}

	private function getPostItem($id){

		$item = array();
		$order_meta = get_post_meta($id, 'product_masonry_order', true);
		$masonry_meta = get_post_meta($id, 'product_masonry_layout', true);
		$masonry_title_skin = get_post_meta($id, 'product_masonry_title_skin', true);

		$title_skin = '';
		if(isset($masonry_title_skin) && $masonry_title_skin !==''){
			$title_skin = $masonry_title_skin;
		}

		$order = 999999;
		if(!empty($order_meta)){
			$order = (int)$order_meta;
		}

		$masonry_class = 'edge-product-default-item';
		if(!empty($masonry_meta)){
			$masonry_class = 'edge-product-'.esc_attr($masonry_meta);
		}

		$item['type'] = 'post';
		$item['id'] = $id;
		$item['order'] = $order;
		$item['masonry_class'] = $masonry_class;
		$item['title'] = get_the_title($id);
		$item['title_skin'] = $title_skin;
		$item['link'] = get_the_permalink($id);
		$item['img_url'] = get_the_post_thumbnail_url($id, 'full');

		$img_style = '';
		if($item['img_url'] !== ''){
			$img_style = 'background-image: url('.esc_url($item['img_url']).')';
		}

		$item['img_url_style'] = $img_style;

		return $item;

	}

	private function getCategoryItem($id, $name, $slug){

		$item = array();

		$order_meta = get_term_meta($id, 'category_masonry_order', true);
		$masonry_meta = get_term_meta($id, 'category_masonry_layout', true);
		$masonry_title_skin = get_term_meta($id, 'category_masonry_title_skin', true);
		$masonry_price_skin = get_term_meta($id, 'category_masonry_price_skin', true);

		$title_skin = '';
		if(isset($masonry_title_skin) && $masonry_title_skin !==''){
			$title_skin = $masonry_title_skin;
		}

		$price_skin = '';
		if(isset($masonry_price_skin) && $masonry_price_skin !==''){
			$price_skin = $masonry_price_skin;
		}

		$order = 999999;
		if(!empty($order_meta)){
			$order = (int)$order_meta;
		}

		$masonry_class = 'edge-product-default-item';
		if(!empty($masonry_meta) && $masonry_meta !== ''){
			$masonry_class = 'edge-product-'.esc_attr($masonry_meta);
		}

		$item['type'] = 'category';
		$item['id'] = $id;
		$item['order'] = $order;
		$item['masonry_class'] = $masonry_class;
		$item['title'] = $name;
		$item['title_skin'] = $title_skin;
		$item['price_skin'] = $price_skin;
		$item['link'] = get_term_link( $id, 'product_cat');
		$img_id = get_term_meta($id, 'thumbnail_id', true);

		$img_src = '';
		$img_style = '';

		if(!empty($img_id)){
			$img_obj = wp_get_attachment_image_src($img_id, 'full');
			if(isset($img_obj[0])){
				$img_src = $img_obj[0];
				$img_style = 'background-image: url('.esc_url($img_src).')';
			}

		}

		$item['img_url'] = $img_src;
		$item['img_url_style'] = $img_style;

		$item['min_price'] = adorn_edge_woo_product_category_min_price($id);

		return $item;

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

	/**
	 * Filter products by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function productIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$product_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'product' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'adorn' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'adorn' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find product by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function productIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get product
			$product = get_post( (int) $query );
			if ( ! is_wp_error( $product ) ) {

				$product_id = $product->ID;
				$product_title = $product->post_title;

				$product_title_display = '';
				if ( ! empty( $product_title ) ) {
					$product_title_display = ' - ' . esc_html__( 'Title', 'adorn' ) . ': ' . $product_title;
				}

				$product_id_display = esc_html__( 'Id', 'adorn' ) . ': ' . $product_id;

				$data          = array();
				$data['value'] = $product_id;
				$data['label'] = $product_id_display . $product_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

}