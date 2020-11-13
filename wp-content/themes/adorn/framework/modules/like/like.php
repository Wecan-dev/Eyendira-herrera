<?php

class AdornEdgeLike {

	private static $instance;

	private function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts'));
		add_action('wp_ajax_adorn_edge_like', array( $this, 'ajax'));
		add_action('wp_ajax_nopriv_adorn_edge_like', array( $this, 'ajax'));
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	function enqueue_scripts() {
		wp_enqueue_script( 'edge-like', EDGE_ASSETS_ROOT . '/js/modules/plugins/like.js', 'jquery', '1.0', TRUE );

		wp_localize_script( 'edge-like', 'edgeLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax(){
		$likes_id = isset( $_POST['likes_id'] ) && ! empty( $_POST['likes_id'] ) ? sanitize_text_field( $_POST['likes_id'] ) : '';
		$post_id  = ! empty( $likes_id ) ? substr( str_replace( 'edge-like-', '', $likes_id ), 0, - 4 ) : '-1';

		check_ajax_referer( 'edgtf_like_nonce_' . $post_id, 'like_nonce' );

		//update
		if ( !empty( $likes_id ) ) {
			$type = isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : '';

			echo wp_kses($this->like_post($post_id, $type, 'update'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		} else {
            echo wp_kses($this->like_post($post_id, $type, 'get'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}
		exit;
	}

	public function like_post($post_id, $type = '', $action = 'get'){
		if(!is_numeric($post_id)) return;


		switch($action) {

			case 'get':
				$like_count = get_post_meta($post_id, '_edge-like', true);
                $like_label = $like_count !== '1' ? esc_html__('likes','adorn') : esc_html__('like','adorn');

				if(isset($_COOKIE['edge-like_'. $post_id])){
                    if($type == 'portfolio-single') {
					$icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    }else{
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    }

                } else {
                    if($type == 'portfolio-single') {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    } else {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    }
                }

				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_edge-like', $like_count, true);
                    $icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';

                    if($type == 'portfolio-single') {

                        $icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
                    }
				}

                if($type == 'portfolio-single') {
                    $return_value = $icon . "<span>" . $like_count . "</span><span>" . $like_label . "</span>";
                    return $return_value;
                } else {
                    $return_value = $icon . "<span>" . $like_count . "</span>";
                    return $return_value;
                }
				break;

			case 'update':
				$like_count = get_post_meta($post_id, '_edge-like', true);
                $like_label = $like_count !== '0' ? esc_html__('likes','adorn') : esc_html__('like','adorn');

				$like_count++;

				update_post_meta($post_id, '_edge-like', $like_count);
				setcookie('edge-like_'. $post_id, $post_id, time()*20, '/');

                    if($type == 'portfolio-single') {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                        $return_value = $icon . "<span>" . $like_count . "</span><span>" . $like_label . "</span>";

                        $return_value .= '</span>';
                    } else {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                        $return_value = $icon . "<span>" . $like_count . "</span>";

                        $return_value .= '</span>';
                    }

					return $return_value;

				break;
			default:
				return '';
				break;
		}
	}

	public function add_like() {
		global $post;

		$output = $this->like_post($post->ID);

		$class = 'edge-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'adorn');
		if( isset($_COOKIE['edge-like_'. $post->ID]) ){
			$class = 'edge-like liked';
			$title = esc_html__('You already like this!', 'adorn');
		}

		return '<a href="#" class="' . esc_attr( $class ) . '" id="edge-like-' . esc_attr( $post->ID ) . '-' . $rand_number . '" title="' . esc_attr( $title ) . '" data-post-id="' . esc_attr( $post->ID ) . '">' . $output . wp_nonce_field( 'edgtf_like_nonce_' . esc_attr( $post->ID ), 'edgtf_like_nonce_' . esc_attr( $post->ID ), true, false ) . '</a>';
	}

	public function add_like_portfolio_list($portfolio_project_id){

		$class = 'edge-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'adorn');
		if( isset($_COOKIE['edge-like_'. $portfolio_project_id]) ){
			$class = 'edge-like liked';
			$title = esc_html__('You already like this!', 'adorn');
		}

		return '<a class="'. $class .'" data-type="portfolio_list" id="edge-like-'. $portfolio_project_id .'-'. $rand_number.'" title="'. $title .'"></a>';
	}

    public function add_like_portfolio_single() {
        global $post;

        $output = $this->like_post($post->ID, 'portfolio-single');

        $class = 'edge-like';
        $rand_number = rand(100, 999);
        $title = esc_html__('Like this', 'adorn');
        if(isset($_COOKIE['edge-like_'.$post->ID])) {
            $class = 'edge-like liked';
            $title = esc_html__('You already liked this!', 'adorn');
        }

        return '<a href="#" class="'.$class.'" data-type="portfolio-single" id="edge-like-'.$post->ID .'-'. $rand_number.'" title="'. $title.'">'.$output.'</a>';
    }
}

if (!function_exists('adorn_edge_create_like')) {
    function adorn_edge_create_like() {
        AdornEdgeLike::get_instance();
    }

    add_action('after_setup_theme', 'adorn_edge_create_like');
}