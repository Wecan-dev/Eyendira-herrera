<?php
namespace EdgeCore\CPT\Shortcodes\PricingItem;

use EdgeCore\Lib;

class PricingItem implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'edge_pricing_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map( array(
            'name' => esc_html__('Edge Pricing Item', 'edge-core'),
            'base' => $this->base,
            'icon' => 'icon-wpb-pricing-item extended-custom-icon',
            'category' => esc_html__('by EDGE', 'edge-core'),
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type'       => 'textfield',
                    'param_name' => 'price_value',
                    'heading'    => esc_html__('Value', 'edge-core')
                ),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'price_color',
                    'heading'    => esc_html__('Price Color', 'edge-core'),
                    'dependency' => array('element' => 'price_value', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'currency',
                    'heading'     => esc_html__('Currency', 'edge-core'),
                    'description' => esc_html__('Default mark is $', 'edge-core')
                ),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'currency_color',
                    'heading'    => esc_html__('Currency Color', 'edge-core'),
                    'dependency' => array('element' => 'currency', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'title',
                    'heading'     => esc_html__('Title', 'edge-core'),
                    'save_always' => true
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'subtitle',
                    'heading'    => esc_html__('Subtitle', 'edge-core')
                ),
                array(
                    'type'       => 'textarea_html',
                    'param_name' => 'content',
                    'heading'    => esc_html__('Content', 'edge-core'),
                    'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'price_value'         		=> '100',
            'price_color'           => '',
            'currency'      		=> '$',
            'currency_color'        => '',
            'title'         		=> '',
            'subtitle'              => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $html = '';

        $params['content']= preg_replace('#^<\/p>|<p>$#', '', $content); // delete p tag before and after content
        $params['price_styles'] = $this->getPriceStyles($params);
        $params['currency_styles'] = $this->getCurrencyStyles($params);

        $html .= edge_core_get_shortcode_module_template_part('templates/pricing-item-template', 'pricing-item', '', $params);

        return $html;
    }



    private function getPriceStyles($params) {
        $itemStyle = array();

        if (!empty($params['price_color'])) {
            $itemStyle[] = 'color: '.$params['price_color'];
        }

        return implode(';', $itemStyle);
    }

    private function getCurrencyStyles($params) {
        $itemStyle = array();

        if (!empty($params['currency_color'])) {
            $itemStyle[] = 'color: '.$params['currency_color'];
        }

        return implode(';', $itemStyle);
    }
}