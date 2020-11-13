<?php
namespace EdgeCore\CPT\Shortcodes\Blockquote;

use EdgeCore\Lib;

/**
 * Class Blockquote
 */
class Blockquote implements Lib\ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edge_blockquote';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see edge_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Blockquote', 'edge-core'),
			'base'                      => $this->getBase(),
			'category' => esc_html__( 'by EDGE', 'edge-core' ),
			'icon'                      => 'icon-wpb-blockquote extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Text', 'edge-core'),
					'param_name'  => 'text',
					'value'       => esc_html__('Blockquote text', 'edge-core'),
					'save_always' => true
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Width (%)', 'edge-core'),
					'param_name' => 'width'
				),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__('Author', 'edge-core'),
                    'param_name' => 'author'
                )
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'text'  => '',
			'width' => '',
            'author' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['blockquote_style'] = $this->getBlockquoteStyle($params);

		//Get HTML from template
		$html = edge_core_get_shortcode_module_template_part('templates/blockquote-template', 'blockquote', '', $params);

		return $html;

	}

	/**
	 * Return Style for Blockquote
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getBlockquoteStyle($params) {
		$blockquote_style = array();

		if ($params['width'] !== '') {
			$width = strstr($params['width'], '%') ? $params['width'] : $params['width'] . '%';
			$blockquote_style[] = 'width: ' . $width;
		}

		return implode(';', $blockquote_style);
	}

	/**
	 * Return Blockquote Title Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 *
	 * @return string
	 */

}