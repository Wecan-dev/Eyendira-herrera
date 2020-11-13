<?php
namespace EdgeCore\CPT\Shortcodes\Message;

use EdgeCore\Lib;

/**
 * Class Message
 */
class Message implements Lib\ShortcodeInterface	{
	private $base; 
	
	function __construct() {
		$this->base = 'edge_message';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
		* Returns base for shortcode
		* @return string
	 */
	public function getBase() {
		return $this->base;
	}	
	public function vcMap() {
						
		vc_map( array(
			'name' => esc_html__('Message', 'edge-core'),
			'base' => $this->base,
			'category' => esc_html__('by EDGE', 'edge-core'),
			'icon' => 'icon-wpb-message extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__('Type', 'edge-core'),
						'param_name' => 'type',
						'value' => array(
							esc_html__('Normal','edge-core') => 'normal',
							esc_html__('With Icon', 'edge-core') => 'with_icon'
						),
						'save_always' => true
					)
				),
                adorn_edge_icon_collections()->getVCParamsArray(array('element' => 'type', 'value' => 'with_icon')),
				array(
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__('Icon Color', 'edge-core'),
						'param_name' => 'icon_color',
						'dependency' => Array('element' => 'type', 'value' => array('with_icon'))
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__('Icon Background Color', 'edge-core'),
						'param_name' => 'icon_background_color',
						'dependency' => Array('element' => 'type', 'value' => array('with_icon'))
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__('Background Color', 'edge-core'),
						'param_name' => 'background_color',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__('Border Color','edge-core'),
						'param_name' => 'border_color',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Border Width (px)', 'edge-core'),
						'param_name' => 'border_width',
						'description' => esc_html__('Default value is 0','edge-core'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Close Icon Color', 'edge-core'),
						'param_name'  => 'close_icon_color',
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Close Icon Hover Color', 'edge-core'),
						'param_name'  => 'close_icon_hover_color',
					),
					array(
						'type' => 'textarea_html',
						'heading' => esc_html__('Content', 'edge-core'),
						'param_name' => 'content',
						'value' => '<p>'.esc_html__("I am test text for Message shortcode.", "edge-core").'</p>',
					)
				)
			)
		) );

	}

	public function render($atts, $content = null) {
		
		$args = array(
            'type' => '',
            'background_color' => '',
            'border_color' => '',
            'border_width' => '',
            'icon_size' => '',
            'icon_custom_size' => '',
            'icon_color' => '',
            'icon_background_color' => '',
			'close_icon_color' => '',
			'close_icon_hover_color' => ''
        );
		
		$args = array_merge($args, adorn_edge_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
        $params['content']= preg_replace('#^<\/p>|<p>$#', '', $content); // delete p tag before and after content

		//Extract params for use in method
		extract($params);
		//Get HTML from template based on type of team
		$iconPackName = adorn_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$message_classes = '';
		
		if ($type == 'with_icon') {
			$message_classes .= ' edge-with-icon';
			$params['icon'] = $params[$iconPackName];
			$params['icon_attributes'] = $this->getIconStyle($params);
		}
		$params['message_classes'] = $message_classes;
		$params['message_styles'] = $this->getHolderStyle($params);
		$params['close_icon_style'] = $this->getCloseColorStyle($params);
		$params['close_icon_holder_style'] = $this->getCloseHolderColorStyle($params);

		
		$html = edge_core_get_shortcode_module_template_part('templates/message-holder-template', 'message', '', $params);
		
		return $html;
	}
	/**
     * Generates message icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyle($params){
		$iconStyles = array();

        if(!empty($params['icon_color'])) {
            $iconStyles[] = 'color: '.$params['icon_color'];
        }

        if(!empty($params['icon_background_color'])) {
            $iconStyles[] = 'background-color:'.$params['icon_background_color'].'';
        }

        return implode(';', $iconStyles);
	}
	 /**
     * Generates message holder styles
     *
     * @param $params
     *
     * @return array
     */
	private function getHolderStyle($params){
		$holderStyles = array();
		
		if(!empty($params['background_color'])) {
            $holderStyles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $holderStyles[] = 'border-color:'.$params['border_color'].'';
        }
		if(!empty($params['border_width'])) {
            $holderStyles[] = 'border-width:'.$params['border_width'].'px';
		}

        return implode(';', $holderStyles);
	}

	private function getCloseColorStyle($params) {
		$close_icon_style = array();

		if($params['close_icon_color'] != '') {
			$close_icon_style[] = 'color: '.$params['close_icon_color'];
		}

		return $close_icon_style;
	}

	private function getCloseHolderColorStyle($params) {
		$close_icon_style = array();

		if($params['close_icon_hover_color'] != '') {
			$close_icon_style[] = 'color: '.$params['close_icon_hover_color'];
		}

		return $close_icon_style;
	}

}