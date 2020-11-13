<?php
use Adorn\Modules\Woo\FieldCreator\SelectField;
use Adorn\Modules\Woo\FieldCreator\InputField;

if ( ! function_exists( 'adorn_edge_woo_category_add_meta_fields' ) ) {

	function adorn_edge_woo_category_add_meta_fields() {

		$html = '';
		$select_field_creator = new SelectField();
		$input_field_creator = new InputField();

		$img_size_options = array(
			'big' => esc_html__('Big', 'adorn'),
			'small'   => esc_html__('Small', 'adorn')
		);

		$img_position_options = array(
			'left' => esc_html__('Left', 'adorn'),
			'right'   => esc_html__('Right', 'adorn')
		);

		$content_options = array(
			'top_left' => esc_html__('Top Left', 'adorn'),
			'top_right'   => esc_html__('Top Right', 'adorn'),
			'bottom_left' => esc_html__('Bottom Left', 'adorn'),
			'bottom_right'   => esc_html__('Bottom Right', 'adorn'),
			'middle_right'   => esc_html__('Middle Right', 'adorn'),
			'middle_left'   => esc_html__('Middle Left', 'adorn'),
		);

		$masonry_layout_options = array(
			'' => esc_html__('Default Item', 'adorn'),
			'large-width-height' => esc_html__('Large Width and Height', 'adorn'),
			'large-width'   => esc_html__('Large Width', 'adorn'),
			'large-height'   => esc_html__('Large Height', 'adorn')
		);

		$skin_options = array(
			'' => esc_html__('Default', 'adorn'),
			'light' => esc_html__('Light', 'adorn'),
			'dark' => esc_html__('Dark', 'adorn'),
		);

		ob_start();
		$select_field_creator->renderField('tax_img_size', esc_html__('Choose Image Size' , 'adorn'), $img_size_options);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('tax_img_position', esc_html__('Choose Image Position(only if small image is choosen)' , 'adorn'), $img_position_options);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('tax_content_position', esc_html__('Choose Content Position' , 'adorn'), $content_options);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('category_masonry_layout', esc_html__('Choose Masonry Layout(for Custom Product List and Category shortcode)' , 'adorn'), $masonry_layout_options);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('category_masonry_title_skin', esc_html__('Choose Masonry Title Skin(for Custom Product List and Category shortcode)' , 'adorn'), $skin_options);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('category_masonry_price_skin', esc_html__('Choose Masonry Price Skin(for Custom Product List and Category shortcode)' , 'adorn'), $skin_options);
		$html .= ob_get_clean();

		ob_start();
		$input_field_creator->renderField('category_masonry_order', esc_html__('Set Category Order in Shortcodes' , 'adorn'));
		$html .= ob_get_clean();


		echo wp_kses_post($html);
		}

	//add_action( 'product_cat_add_form_fields', 'adorn_edge_woo_category_add_meta_fields', 10, 2 );

}

if ( ! function_exists( 'adorn_edge_woo_category_edit_meta_fields' ) ) {

	function adorn_edge_woo_category_edit_meta_fields($term, $taxonomy) {

		$img_size = get_term_meta( $term->term_id, 'tax_img_size', true );
		$img_position = get_term_meta( $term->term_id, 'tax_img_position', true );
		$content_position = get_term_meta( $term->term_id, 'tax_content_position', true );
		$masonry_layout = get_term_meta( $term->term_id, 'category_masonry_layout', true );
		$masonry_order = get_term_meta( $term->term_id, 'category_masonry_order', true );
		$masonry_title_skin = get_term_meta( $term->term_id, 'category_masonry_title_skin', true );
		$masonry_price_skin = get_term_meta( $term->term_id, 'category_masonry_price_skin', true );

		$html = '';
		$select_field_creator = new SelectField();
		$input_field_creator = new InputField();

		$img_size_options = array(
			'big' => esc_html__('Big', 'adorn'),
			'small'   => esc_html__('Small', 'adorn')
		);

		$img_position_options = array(
			'left' => esc_html__('Left', 'adorn'),
			'right'   => esc_html__('Right', 'adorn')
		);

		$content_options = array(
			'top-left' => esc_html__('Top Left', 'adorn'),
			'top-right'   => esc_html__('Top Right', 'adorn'),
			'bottom-left' => esc_html__('Bottom Left', 'adorn'),
			'bottom-right'   => esc_html__('Bottom Right', 'adorn'),
			'middle-right'   => esc_html__('Middle Right', 'adorn'),
			'middle-left'   => esc_html__('Middle Left', 'adorn'),
		);

		$masonry_layout_options = array(
			'' => esc_html__('Default Item', 'adorn'),
			'large-width-height' => esc_html__('Large Width and Height', 'adorn'),
			'large-width'   => esc_html__('Large Width', 'adorn'),
			'large-height'   => esc_html__('Large Height', 'adorn')
		);
		$skin_options = array(
			'' => esc_html__('Default', 'adorn'),
			'light' => esc_html__('Light', 'adorn'),
			'dark' => esc_html__('Dark', 'adorn'),
		);

		ob_start();
		$select_field_creator->renderField('tax_img_size', esc_html__('Choose Image Size' , 'adorn'), $img_size_options, $img_size);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('tax_img_position', esc_html__('Choose Image Position(only if small image is choosen)' , 'adorn'), $img_position_options, $img_position);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('tax_content_position', esc_html__('Choose Content Position' , 'adorn'), $content_options, $content_position);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('category_masonry_layout', esc_html__('Choose Masonry Layout(for Custom Product List and Category shortcode)' , 'adorn'), $masonry_layout_options, $masonry_layout);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('category_masonry_title_skin', esc_html__('Choose Masonry Title Skin(for Custom Product List and Category shortcode)' , 'adorn'), $skin_options, $masonry_title_skin);
		$html .= ob_get_clean();

		ob_start();
		$select_field_creator->renderField('category_masonry_price_skin', esc_html__('Choose Masonry Price Skin(for Custom Product List and Category shortcode)' , 'adorn'), $skin_options, $masonry_price_skin);
		$html .= ob_get_clean();

		ob_start();
		$input_field_creator->renderField('category_masonry_order', esc_html__('Set Category Order' , 'adorn'),$masonry_order);
		$html .= ob_get_clean();


		echo adorn_edge_get_module_part($html);
	}

	add_action( 'product_cat_edit_form_fields', 'adorn_edge_woo_category_edit_meta_fields', 10, 2 );

}

if ( ! function_exists( 'adorn_edge_woo_category_save_meta_fields' ) ) {

	function adorn_edge_woo_category_save_meta_fieldss( $term_id, $taxonomy_id ) {

		if ( isset( $_POST ) ) {



			if(isset($_POST['tax_img_size'])){
				add_term_meta($term_id, 'tax_img_size', esc_attr($_POST['tax_img_size']), true );
			}

			if(isset($_POST['tax_img_position'])){
				add_term_meta($term_id, 'tax_img_position', esc_attr($_POST['tax_img_position']), true );
			}

			if ( isset($_POST['tax_content_position'])) {
				add_term_meta( $term_id, 'tax_content_position', esc_attr($_POST['tax_content_position']), true );
			}

			if ( isset($_POST['category_masonry_layout'])) {
				add_term_meta( $term_id, 'category_masonry_layout', esc_attr($_POST['category_masonry_layout']), true );
			}

			if ( isset($_POST['category_masonry_price_skin'])) {
				add_term_meta( $term_id, 'category_masonry_price_skin', esc_attr($_POST['category_masonry_price_skin']), true );
			}

			if ( isset($_POST['category_masonry_title_skin'])) {
				add_term_meta( $term_id, 'category_masonry_title_skin', esc_attr($_POST['category_masonry_title_skin']), true );
			}


			if ( isset($_POST['category_masonry_order'])) {
				add_term_meta( $term_id, 'category_masonry_order', esc_attr($_POST['category_masonry_order']), true );
			}
		}
	}

//	add_action( 'created_term', 'adorn_edge_woo_category_save_meta_fields', 10, 2 );

}

if ( ! function_exists( 'adorn_edge_woo_category_update_meta_fields' ) ) {
	/**
	 * Update listing location taxonomy meta field
	 *
	 * @param $term_id
	 * @param $taxonomy_id
	 */
	function adorn_edge_woo_category_update_meta_fields( $term_id, $taxonomy_id ) {

		if ( isset( $_POST ) ) {

			if(isset($_POST['tax_img_size'])){
				update_term_meta($term_id, 'tax_img_size', esc_attr($_POST['tax_img_size']));
			}

			if(isset($_POST['tax_img_position'])){
				update_term_meta($term_id, 'tax_img_position', esc_attr($_POST['tax_img_position']));
			}

			if ( isset($_POST['tax_content_position'])) {
				update_term_meta( $term_id, 'tax_content_position', esc_attr( $_POST['tax_content_position']) );
			}

			if ( isset($_POST['category_masonry_layout'])) {
				update_term_meta( $term_id, 'category_masonry_layout', esc_attr( $_POST['category_masonry_layout']) );
			}

			if ( isset($_POST['category_masonry_title_skin'])) {
				update_term_meta( $term_id, 'category_masonry_title_skin', esc_attr( $_POST['category_masonry_title_skin']) );
			}

			if ( isset($_POST['category_masonry_price_skin'])) {
				update_term_meta( $term_id, 'category_masonry_price_skin', esc_attr( $_POST['category_masonry_price_skin']) );
			}

			if ( isset($_POST['category_masonry_order'])) {
				update_term_meta( $term_id, 'category_masonry_order', esc_attr( $_POST['category_masonry_order']) );
			}

		}

	}

	add_action( 'edited_product_cat', 'adorn_edge_woo_category_update_meta_fields', 10, 2 );

}