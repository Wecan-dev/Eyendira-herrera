<?php

class AdornEdgeSideAreaOpener extends AdornEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edge_side_area_opener',
	        esc_html__('Edge Side Area Opener', 'adorn'),
	        array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'adorn'))
        );

        $this->setParams();
    }
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__('Side Area Opener Color', 'adorn'),
				'description' => esc_html__('Define color for side area opener', 'adorn')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__('Side Area Opener Hover Color', 'adorn'),
				'description' => esc_html__('Define hover color for side area opener', 'adorn')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__('Side Area Opener Margin', 'adorn'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'adorn')
			),
			array(
				'type' => 'textfield',
				'name' => 'widget_title',
				'title' => esc_html__('Side Area Opener Title', 'adorn')
			)
		);
	}
	
	public function widget($args, $instance) {
		$holder_styles = array();
		if (!empty($instance['icon_color'])) {
			$holder_styles[] = 'color: ' . $instance['icon_color'].';';
		}
		if (!empty($instance['widget_margin'])) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		<a class="edge-side-menu-button-opener edge-icon-has-hover" <?php echo adorn_edge_get_inline_attr($instance['icon_hover_color'], 'data-hover-color'); ?> href="javascript:void(0)" <?php adorn_edge_inline_style($holder_styles); ?>>
			<?php if (!empty($instance['widget_title'])) { ?>
				<h5 class="edge-side-menu-title"><?php echo esc_html($instance['widget_title']); ?></h5>
			<?php } ?>
			<span class="edge-side-menu-lines">
        		<span class="edge-side-menu-line edge-line-1"></span>
        		<span class="edge-side-menu-line edge-line-2"></span>
                <span class="edge-side-menu-line edge-line-3"></span>
        	</span>
		</a>
	<?php }
}