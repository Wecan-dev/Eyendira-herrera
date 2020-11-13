<?php
namespace EdgeCore\CPT\Shortcodes\SplitScrollingSectionLeftPanel;

use EdgeCore\Lib;

class SplitScrollingSectionLeftPanel implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'edge_split_scrolling_section_left_panel';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Edge Left Fixed Panel', 'edge-core'),
				'base' => $this->base,
				'as_parent'	=> array('only' => 'edge_split_scrolling_section_content_item'),
				'as_child'	=> array('only' => 'edge_split_scrolling_section'),
				'content_element' => true,
				'category' => esc_html__('by EDGE', 'edge-core'),
				'icon' => 'icon-wpb-split-scrolling-section-left-panel extended-custom-icon',
				'show_settings_on_create' => false,
				'js_view' => 'VcColumnView'
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array();
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$html = '<div class="edge-sss-ms-left">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}
