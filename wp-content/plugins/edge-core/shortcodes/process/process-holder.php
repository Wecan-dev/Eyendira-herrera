<?php
namespace EdgeCore\CPT\Shortcodes\ProcessHolder;

use EdgeCore\Lib;

class ProcessHolder implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edge_process_holder';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Process Holder', 'edge-core'),
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'edge_process_item'),
            'category'                => esc_html__('by EDGE', 'edge-core'),
            'icon'                    => 'icon-wpb-process extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'number_of_items',
                    'heading'     => esc_html__('Number of Process Items', 'edge-core'),
                    'value'       => array(
                        esc_html__('Three', 'edge-core') => 'three',
                        esc_html__('Four', 'edge-core')  => 'four'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => ''
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_items' => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        $params['content'] = $content;

        $params['holder_classes'] = array(
            'edge-process-holder',
            'edge-process-holder-items-'.$params['number_of_items']
        );

        return edge_core_get_shortcode_module_template_part('templates/process-holder-template', 'process', '', $params);
    }
}