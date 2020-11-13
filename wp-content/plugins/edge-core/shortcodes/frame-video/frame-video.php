<?php
namespace EdgeCore\CPT\Shortcodes\FrameVideo;

use EdgeCore\Lib;

class FrameVideo implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edge_frame_video';

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
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Edge Frame Video', 'edge-core'),
            'base'                      => $this->getBase(),
            'category'                  => esc_html__('by EDGE', 'edge-core'),
            'icon'                      => 'icon-wpb-video-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
	            array(
		            'type'       => 'textfield',
		            'param_name' => 'video_link',
		            'heading'    => esc_html__('Video Link', 'edge-core')
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
			'video_link'              => '#'
		);
		
		$params = shortcode_atts($args, $atts);
		
		//Get HTML from template
		$html = edge_core_get_shortcode_module_template_part('templates/frame-video', 'frame-video', '', $params);
		
		return $html;
	}
}