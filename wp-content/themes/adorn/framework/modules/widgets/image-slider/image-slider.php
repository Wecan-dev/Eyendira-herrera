<?php

class AdornEdgeImageSliderWidget extends AdornEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edge_image_slider_widget',
            esc_html__('Edge Image Slider Widget', 'adorn'),
            array( 'description' => esc_html__( 'Add image slider element to widget areas', 'adorn'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'textfield',
                'name' => 'extra_class',
                'title' => esc_html__('Custom CSS Class', 'adorn')
            ),
            array(
                'type' => 'textfield',
                'name' => 'widget_title',
                'title' => esc_html__('Widget Title', 'adorn')
            ),
            array(
                'type'        => 'textfield',
                'name'        => 'images',
                'title'       => esc_html__('Image ID\'s', 'adorn'),
	            'description' => esc_html__('Add images id for your image slider widget, separate id\'s with comma', 'adorn')
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        extract($args);

        $extra_class = '';
        if (!empty($instance['extra_class']) && $instance['extra_class'] !== '') {
            $extra_class = $instance['extra_class'];
        }
	
	    $image_slider_html = '';
        
	    $image_ids = array();
	
	    if ($instance['images'] !== '') {
		    $image_ids = explode(',', $instance['images']);
	    }
	
	    foreach ($image_ids as $id) {

		    $image_original = wp_get_attachment_image_src($id, 'full');
		    $image_url = $image_original[0];
		    $image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
		
		    $image_slider_html .= '<img itemprop="image" class="edge-is-widget-image" src="'.esc_url($image_url).'" alt="'.esc_attr($image_alt).'" />';
	    }



	    $data_params = 'data-number-of-items="3"';
	    $data_params .= ' data-slider-margin="20"';
	    $data_params .= ' data-enable-dots-data="yes"';
	    $data_params .= ' data-enable-pagination="no"';
	    $data_params .= ' data-enable-navigation="no"';
        ?>

        <div class="widget edge-image-slider-widget <?php echo esc_attr($extra_class); ?>">

            <?php if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
	            echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
            }
            if (!empty($image_slider_html)) {
                print '<div class="edge-is-widget-inner edge-owl-slider" '.wp_kses($data_params, array('data')).'>';
                    echo wp_kses_post($image_slider_html);
                print '</div>';
            }

            ?>
        </div>
    <?php 
    }
}