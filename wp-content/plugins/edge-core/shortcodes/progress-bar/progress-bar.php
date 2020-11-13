<?php
namespace EdgeCore\CPT\Shortcodes\ProgressBar;

use EdgeCore\Lib;

class ProgressBar implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edge_progress_bar';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Progress Bar', 'edge-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-progress-bar extended-custom-icon',
			'category' => esc_html__('by EDGE', 'edge-core'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type'       => 'textfield',
					'param_name' => 'percent',
					'heading'    => esc_html__('Percentage', 'edge-core')
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'title',
					'heading'    => esc_html__('Title', 'edge-core')
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'title_tag',
					'heading'     => esc_html__('Title Tag', 'edge-core'),
					'value'       => array_flip(adorn_edge_get_title_tag(true, array('p' => 'p'))),
					'save_always' => true,
					'dependency'  => array('element' => 'title', 'not_empty' => true)
				),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'skin',
                    'heading'    => esc_html__('Skin', 'edge-core'),
                    'value'      => array(
                        esc_html__('Default','edge-core') => 'default',
                        esc_html__('Dark','edge-core') => 'dark',
                        esc_html__('Light','edge-core') => 'light'
                    )
                ),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_color',
					'heading'    => esc_html__('Title Color', 'edge-core'),
					'dependency' => array(
                        'element' => 'skin', 'value' => 'default'
                    )
				),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'color_active',
                    'heading'    => esc_html__('Active Color', 'edge-core'),
                    'dependency' => array(
                        'element' => 'skin', 'value' => 'default'
                    )
                ),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'color_inactive',
                    'heading'    => esc_html__('Inactive Color', 'edge-core'),
                    'dependency' => array(
                        'element' => 'skin', 'value' => 'default'
                    )
                )
			)
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'percent'        => '100',
			'title'          => '',
			'title_tag'      => 'h6',
			'title_color'    => '',
			'color_active'   => '',
			'color_inactive' => '',
            'skin'           => 'default'
        );
		
		$params = shortcode_atts($args, $atts);
		
		$params['title_tag']          = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']       = $this->getTitleStyles($params);
		
		$params['active_bar_style']   = $this->getActiveColor($params);
		$params['inactive_bar_style'] = $this->getInactiveColor($params);
        $params['progress_bar_classes'] = $this->getProgressBarClasses($params);
		
        //init variables
		$html = edge_core_get_shortcode_module_template_part('templates/progress-bar-template', 'progress-bar', '', $params);
		
        return $html;
	}
	
	/**
	 * Return styles for title
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getTitleStyles($params) {
		$styles = array();
		
		if(!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}
		
		return $styles;
	}

    /**
     * Return active color for active bar
     *
     * @param $params
     *
     * @return array
     */
    private function getActiveColor($params) {
        $styles = array();

        if(!empty($params['color_active'])) {
            $styles[] = 'background-color: '.$params['color_active'];
        }

        return $styles;
    }

    /**
     * Return active color for inactive bar
     *
     * @param $params
     *
     * @return array
     */
    private function getInactiveColor($params) {
        $styles = array();

        if(!empty($params['color_inactive'])) {
            $styles[] = 'background-color: '.$params['color_inactive'];
        }

        return $styles;
    }

    /**
     * Generates css classes for Progress Bar
     *
     * @param $params
     *
     * @return array
     */
    private function getProgressBarClasses($params){

        $styles = array();
        $styles[] = 'edge-progress-bar';


        if($params['skin'] !== ''){
            $styles[] = 'edge-progress-bar-'.$params['skin'];
        }

        return implode(' ', $styles);
    }

}