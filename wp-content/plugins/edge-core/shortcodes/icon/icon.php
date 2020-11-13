<?php
namespace EdgeCore\CPT\Shortcodes\Icon;

use EdgeCore\Lib;

class Icon implements Lib\ShortcodeInterface {
	
    public function __construct() {
        $this->base = 'edge_icon';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     *
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Edge Icon', 'edge-core'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by EDGE', 'edge-core'),
            'icon'                      => 'icon-wpb-icon extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                \AdornEdgeIconCollections::get_instance()->getVCParamsArray(),
                array(
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'size',
                        'heading'    => esc_html__('Size', 'edge-core'),
                        'value'      => array(
	                        esc_html__('Tiny', 'edge-core')       => 'edge-icon-tiny',
	                        esc_html__('Small', 'edge-core')      => 'edge-icon-small',
	                        esc_html__('Medium', 'edge-core')     => 'edge-icon-medium',
	                        esc_html__('Large', 'edge-core')      => 'edge-icon-large',
	                        esc_html__('Huge', 'edge-core') => 'edge-icon-huge'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'custom_size',
                        'heading'    => esc_html__('Custom Size (px)', 'edge-core')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'type',
                        'heading'    => esc_html__('Type', 'edge-core'),
                        'value'      => array(
						    esc_html__('Normal', 'edge-core') => 'edge-normal',
						    esc_html__('Circle', 'edge-core') => 'edge-circle',
						    esc_html__('Square', 'edge-core') => 'edge-square'
                        )
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'border_radius',
                        'heading'     => esc_html__('Border Radius', 'edge-core'),
                        'description' => esc_html__('Please insert border radius(Rounded corners) in px. For example: 4 ', 'edge-core'),
                        'dependency'  => array('element' => 'type', 'value' => array('edge-square'))
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'shape_size',
                        'heading'    => esc_html__('Shape Size (px)', 'edge-core'),
                        'dependency' => array('element' => 'type', 'value' => array('edge-circle', 'edge-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_color',
                        'heading'    => esc_html__('Icon Color', 'edge-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'border_color',
                        'heading'    => esc_html__('Border Color', 'edge-core'),
                        'dependency' => array('element' => 'type', 'value' => array('edge-circle', 'edge-square'))
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'border_width',
                        'heading'    => esc_html__('Border Width', 'edge-core'),
                        'dependency' => array('element' => 'type', 'value' => array('edge-circle', 'edge-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'background_color',
                        'heading'    => esc_html__('Background Color', 'edge-core'),
                        'dependency' => array('element' => 'type', 'value' => array('edge-circle', 'edge-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_icon_color',
                        'heading'    => esc_html__('Hover Icon Color', 'edge-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_border_color',
                        'heading'    => esc_html__('Hover Border Color', 'edge-core'),
                        'dependency' => array('element' => 'type', 'value' => array('edge-circle', 'edge-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_background_color',
                        'heading'    => esc_html__('Hover Background Color', 'edge-core'),
                        'dependency' => array('element' => 'type', 'value' => array('edge-circle', 'edge-square'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'margin',
                        'heading'     => esc_html__('Margin', 'edge-core'),
                        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'edge-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'icon_animation',
                        'heading'     => esc_html__('Icon Animation', 'edge-core'),
                        'value'       => array_flip(adorn_edge_get_yes_no_select_array(false))
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'icon_animation_delay',
                        'heading'    => esc_html__('Icon Animation Delay (ms)', 'edge-core'),
                        'dependency' => array('element' => 'icon_animation', 'value' => 'yes')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'link',
                        'heading'    => esc_html__('Link', 'edge-core')
                    ),
                    array(
                        'type'        => 'checkbox',
                        'param_name'  => 'anchor_icon',
                        'heading'     => esc_html__('Use Link as Anchor', 'edge-core'),
                        'value'       => array('Use this icon as Anchor?' => 'yes'),
                        'description' => esc_html__('Check this box to use icon as anchor link (eg. #contact)', 'edge-core'),
                        'dependency'  => Array('element' => 'link', 'not_empty' => true)
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'target',
                        'heading'    => esc_html__('Target', 'edge-core'),
                        'value'      => array_flip(adorn_edge_get_link_target_array()),
                        'dependency' => array('element' => 'link', 'not_empty' => true)
                    )
                )
            )
        ));
    }

    /**
     * Renders shortcode's HTML
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'custom_size'            => '',
            'type'                   => 'edge-normal',
            'border_radius'          => '',
            'shape_size'             => '',
            'icon_color'             => '',
            'border_color'           => '',
            'border_width'           => '',
            'background_color'       => '',
            'hover_icon_color'       => '',
            'hover_border_color'     => '',
            'hover_background_color' => '',
            'margin'                 => '',
            'icon_animation'         => '',
            'icon_animation_delay'   => '',
            'link'                   => '',
            'anchor_icon'            => '',
            'target'                 => '_self'
        );

        $default_atts = array_merge($default_atts, adorn_edge_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $iconPackName = adorn_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        //generate icon holder classes
        $iconHolderClasses = array('edge-icon-shortcode', $params['type']);

        if($params['icon_animation'] == 'yes') {
            $iconHolderClasses[] = 'edge-icon-animation';
        }

        if($params['custom_size'] == '') {
            $iconHolderClasses[] = $params['size'];
        }

        //prepare params for template
        $params['icon']                  = $params[$iconPackName];
        $params['icon_holder_classes']   = $iconHolderClasses;
        $params['icon_holder_styles']    = $this->generateIconHolderStyles($params);
        $params['icon_holder_data']      = $this->generateIconHolderData($params);
        $params['icon_params']           = $this->generateIconParams($params);
        $params['icon_animation_holder'] = isset($params['icon_animation']) && $params['icon_animation'] == 'yes';
        $params['icon_animation_holder_styles'] = $this->generateIconAnimationHolderStyles($params);
	    $params['link_class']            = $this->getLinkClass($params);
	    $params['target']                = !empty($params['target']) ? $params['target'] : $default_atts['target'];
	    
        $html = edge_core_get_shortcode_module_template_part('templates/icon', 'icon', '', $params);

        return $html;
    }

    /**
     * Generates icon parameters array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconParams($params) {
        $iconParams = array('icon_attributes' => array());

        $iconParams['icon_attributes']['style'] = $this->generateIconStyles($params);
        $iconParams['icon_attributes']['class'] = 'edge-icon-element';

        return $iconParams;
    }

    /**
     * Generates icon styles array
     *
     * @param $params
     *
     * @return string
     */
    private function generateIconStyles($params) {
        $iconStyles = array();

        if(!empty($params['icon_color'])) {
            $iconStyles[] = 'color: '.$params['icon_color'];
        }

        if(($params['type'] !== 'edge-normal' && !empty($params['shape_size'])) || ($params['type'] == 'edge-normal')) {
            if(!empty($params['custom_size'])) {
                $iconStyles[] = 'font-size:'.adorn_edge_filter_px($params['custom_size']).'px';
            }
        }

        return implode(';', $iconStyles);
    }

    /**
     * Generates icon holder styles for circle and square icon type
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconHolderStyles($params) {
        $iconHolderStyles = array();

        if(isset($params['margin']) && $params['margin'] !== '') {
            $iconHolderStyles[] = 'margin: '.$params['margin'];
        }

        //generate styles attribute only if type isn't normal
        if(isset($params['type']) && $params['type'] !== 'edge-normal') {

            $shapeSize = '';
            if(!empty($params['shape_size'])) {
                $shapeSize = $params['shape_size'];
            } elseif(!empty($params['custom_size'])) {
                $shapeSize = $params['custom_size'];
            }

            if(!empty($shapeSize)) {
                $iconHolderStyles[] = 'width: '.adorn_edge_filter_px($shapeSize).'px';
                $iconHolderStyles[] = 'height: '.adorn_edge_filter_px($shapeSize).'px';
                $iconHolderStyles[] = 'line-height: '.adorn_edge_filter_px($shapeSize).'px';
            }

            if(!empty($params['background_color'])) {
                $iconHolderStyles[] = 'background-color: '.$params['background_color'];
            }

            if(!empty($params['border_color']) && (isset($params['border_width']) && $params['border_width'] !== '')) {
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-color: '.$params['border_color'];
				$iconHolderStyles[] = 'border-width: '.adorn_edge_filter_px($params['border_width']).'px';
			} else if(isset($params['border_width']) && $params['border_width'] !== ''){
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-width: '.adorn_edge_filter_px($params['border_width']).'px';
			} else if(!empty($params['border_color'])){
				$iconHolderStyles[] = 'border-color: '.$params['border_color'];
			}

            if($params['type'] == 'edge-square') {
                if(isset($params['border_radius']) && $params['border_radius'] !== '') {
                    $iconHolderStyles[] = 'border-radius: '.adorn_edge_filter_px($params['border_radius']).'px';
                }
            }
        }

        return $iconHolderStyles;
    }

    /**
     * Generates icon holder data attribute array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconHolderData($params) {
        $iconHolderData = array();

        if(isset($params['type']) && $params['type'] !== 'edge-normal') {
            if(!empty($params['hover_border_color'])) {
                $iconHolderData['data-hover-border-color'] = $params['hover_border_color'];
            }

            if(!empty($params['hover_background_color'])) {
                $iconHolderData['data-hover-background-color'] = $params['hover_background_color'];
            }
        }

        if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes')
           && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')
        ) {
            $iconHolderData['data-animation-delay'] = $params['icon_animation_delay'];
        }

        if(!empty($params['hover_icon_color'])) {
            $iconHolderData['data-hover-color'] = $params['hover_icon_color'];
        }

        if(!empty($params['icon_color'])) {
            $iconHolderData['data-color'] = $params['icon_color'];
        }

        return $iconHolderData;
    }

    private function generateIconAnimationHolderStyles($params) {
        $styles = array();

        if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes') && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')) {
            $styles[] = 'transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-webkit-transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-moz-transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-ms-transition-delay: '.$params['icon_animation_delay'].'ms';
        }

        return $styles;
    }

    private function getLinkClass($params) {
        $class = '';

        if($params['anchor_icon'] != '' && $params['anchor_icon'] == 'yes') {
            $class .= 'edge-anchor';
        }

        return $class;
    }
}