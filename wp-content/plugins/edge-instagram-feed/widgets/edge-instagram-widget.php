<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class EdgeInstagramWidget extends WP_Widget {
	
	protected $params;
	
	public function __construct() {
		parent::__construct(
			'edge_instagram_widget',
			esc_html__( 'Edge Instagram Widget', 'edge-instagram-feed' ),
			array(
				'description' => esc_html__( 'Display your Instagram feed', 'edge-instagram-feed' )
			)
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'name'  => 'title',
				'type'  => 'textfield',
				'title' => esc_html__( 'Title', 'edge-instagram-feed' )
			),
			array(
				'name'    => 'type',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Type', 'edge-instagram-feed' ),
				'options' => array(
					'gallery'  => esc_html__( 'Gallery', 'edge-instagram-feed' ),
					'carousel' => esc_html__( 'Carousel', 'edge-instagram-feed' )
				)
			),
			array(
				'name'    => 'number_of_cols',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Number of Columns', 'edge-instagram-feed' ),
				'options' => array(
					'2' => esc_html__( 'Two', 'edge-instagram-feed' ),
					'3' => esc_html__( 'Three', 'edge-instagram-feed' ),
					'4' => esc_html__( 'Four', 'edge-instagram-feed' ),
					'6' => esc_html__( 'Six', 'edge-instagram-feed' ),
					'7' => esc_html__( 'Seven', 'edge-instagram-feed' ),
					'8' => esc_html__( 'Eight', 'edge-instagram-feed' ),
					'9' => esc_html__( 'Nine', 'edge-instagram-feed' )
				)
			),
			array(
				'name'  => 'number_of_photos',
				'type'  => 'textfield',
				'title' => esc_html__( 'Number of Photos', 'edge-instagram-feed' )
			),
			array(
				'name'    => 'image_size',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Image Size', 'edge-instagram-feed' ),
				'options' => array(
					'thumbnail'           => esc_html__( 'Small', 'edge-instagram-feed' ),
					'low_resolution'      => esc_html__( 'Medium', 'edge-instagram-feed' ),
					'standard_resolution' => esc_html__( 'Large', 'edge-instagram-feed' )
				)
			),
			array(
				'name'    => 'space_between_items',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Space Between Items', 'edge-instagram-feed' ),
				'options' => array(
					'normal' => esc_html__( 'Normal', 'edge-instagram-feed' ),
					'small'  => esc_html__( 'Small', 'edge-instagram-feed' ),
					'tiny'   => esc_html__( 'Tiny', 'edge-instagram-feed' ),
					'no'     => esc_html__( 'No Space', 'edge-instagram-feed' )
				)
			),
			array(
				'name'  => 'transient_time',
				'type'  => 'textfield',
				'title' => esc_html__( 'Images Cache Time', 'edge-instagram-feed' )
			),
			array(
				'name'  => 'caption_text',
				'type'  => 'textfield',
				'title' => esc_html__( 'Images Caption Text', 'edge-instagram-feed' )
			)
		);
	}
	
	public function getParams() {
		return $this->params;
	}
	
	public function widget( $args, $instance ) {
		extract( $instance );
		
		echo adorn_edge_get_module_part($args['before_widget']);
		if ( ! empty( $title ) ) {
			echo adorn_edge_get_module_part($args['before_title'] . $title . $args['after_title']);
		}
		
		$instagram_api = EdgeInstagramApi::getInstance();
		$tag           = ''; // this variable need to be removed from this widget because is not used
		$images_array  = $instagram_api->getImages( $number_of_photos, $tag, array(
			'use_transients' => true,
			'transient_name' => $args['widget_id'],
			'transient_time' => $transient_time
		) );
		
		$type                = ! empty( $type ) ? $type : 'gallery';
		$number_of_cols      = $number_of_cols == '' ? 3 : $number_of_cols;
		$space_between_items = ! empty( $space_between_items ) ? $space_between_items : 'normal';
		
		$widget_class = '';
		$slider_data  = array();
		
		if ( $type === 'carousel' ) {
			$widget_class = 'edge-instagram-carousel edge-owl-slider';
			
			$slider_margin = 0;
			if ( $space_between_items === 'normal' ) {
				$slider_margin = 30;
			} else if ( $space_between_items === 'small' ) {
				$slider_margin = 20;
			} else if ( $space_between_items === 'tiny' ) {
				$slider_margin = 10;
			} else if ( $space_between_items === 'no' ) {
				$slider_margin = 0;
			}
			
			$slider_data['data-number-of-items']   = esc_attr( $number_of_cols );
			$slider_data['data-slider-margin']     = esc_attr( $slider_margin );
			$slider_data['data-enable-navigation'] = 'no';
			$slider_data['data-enable-pagination'] = 'no';
		} else if ( $type == 'gallery' ) {
			$widget_class = 'edge-instagram-gallery edge-' . esc_attr( $space_between_items ) . '-space';
		}

		$caption = esc_html__('Instagram', 'edge-instagram-feed');

		if($caption_text && $caption_text !== ''){
	        $caption = esc_attr($caption_text);
        }

		if ( is_array( $images_array ) && count( $images_array ) ) { ?>

            <div class="edge-instagram-text">
				<?php
				    echo wp_kses_post($caption);
				?>
            </div>

			<ul class="edge-instagram-feed clearfix edge-col-<?php echo esc_attr( $number_of_cols ); ?> <?php echo esc_attr( $widget_class ); ?>" <?php echo adorn_edge_get_inline_attrs( $slider_data ); ?>>
                <?php
				foreach ( $images_array as $image ) { ?>
					<li>
						<a href="<?php echo esc_url( $instagram_api->getHelper()->getImageLink( $image ) ); ?>" target="_blank">
							<?php echo adorn_edge_kses_img( $instagram_api->getHelper()->getImageHTML( $image, $image_size ) ); ?>
                            <span class="overlay-icon social-instagram"><i class="edge-social-icon-widget fa fa-instagram"></i></span>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php }

		echo adorn_edge_get_module_part($args['after_widget']);
	}
	
	public function form( $instance ) {
		foreach ( $this->params as $param_array ) {
			$param_name    = $param_array['name'];
			${$param_name} = isset( $instance[ $param_name ] ) ? esc_attr( $instance[ $param_name ] ) : '';
		}
		
		$instagram_api = EdgeInstagramApi::getInstance();
		
		//user has connected with instagram. Show form
		if ( $instagram_api->hasUserConnected() ) {
			foreach ( $this->params as $param ) {
				switch ( $param['type'] ) {
					case 'textfield':
						?>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
							<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
						</p>
						<?php
						break;
					case 'dropdown':
						?>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
							<?php if ( isset( $param['options'] ) && is_array( $param['options'] ) && count( $param['options'] ) ) { ?>
								<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>">
									<?php foreach ( $param['options'] as $param_option_key => $param_option_val ) {
										$option_selected = '';
										if ( ${$param['name']} == $param_option_key ) {
											$option_selected = 'selected';
										}
										?>
										<option <?php echo esc_attr( $option_selected ); ?> value="<?php echo esc_attr( $param_option_key ); ?>"><?php echo esc_attr( $param_option_val ); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</p>
						
						<?php
						break;
				}
			}
		}
	}
}

function edge_instagram_widget_load() {
	register_widget( 'EdgeInstagramWidget' );
}

add_action( 'widgets_init', 'edge_instagram_widget_load' );