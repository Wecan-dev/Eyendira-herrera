<?php

/**
 * Widget that adds popup icon that triggers opening of popup form
 *
 * Class Edge_Popup_Opener
 */
class AdornEdgePopupOpener extends AdornEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edge_popup_opener',
            esc_html__('Edge Pop-up Opener', 'adorn'),
            array( 'description' => esc_html__( 'Display a "pop-up" icon that opens the pop-up form', 'adorn'))
        );

        $this->setParams();
    }

    protected function setParams() {

        $this->params = array(
            array(
                'name'			=> 'popup_opener_text',
                'type'			=> 'textfield',
                'title'			=> esc_html__('Pop-up Opener Text', 'adorn'),
                'description'	=> esc_html__('Enter text for pop-up opener', 'adorn')
            ),
            array(
                'name'			=> 'popup_opener_color',
                'type'			=> 'textfield',
                'title'			=> esc_html__('Pop-up Opener Color', 'adorn'),
                'description'	=> esc_html__('Define color for pop-up opener', 'adorn')
            )
        );
    }

    public function widget($args, $instance) {

        $popup_styles = array();
        $popup_text = esc_html__('Newsletter', 'adorn');

        if ( !empty($instance['popup_opener_color']) ) {
            $popup_styles[] = 'color: ' . $instance['popup_opener_color'];
        }
        if ( !empty($instance['popup_opener_text']) ) {
            $popup_text = $instance['popup_opener_text'];
        }
        ?>
        <a class="edge-popup-opener" <?php adorn_edge_inline_style($popup_styles) ?> href="javascript:void(0)">
            <span class="edge-popup-opener-text"><?php echo esc_html($popup_text); ?></span>
        </a>
    <?php }
}