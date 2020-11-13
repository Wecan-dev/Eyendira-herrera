<?php
class AdornEdgeYithWishlist extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'edge_woocommerce_yith_wishlist',
			esc_html__('Edge Woocommerce Wishlist', 'adorn'),
			array( 'description' => esc_html__( 'Display a wishlist icon with number of products that are in the wishlist', 'adorn' ), )
		);
	}

    /**
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach($this->params as $param) {
            $param_name = $param['name'];

            $instance[$param_name] = sanitize_text_field($new_instance[$param_name]);
        }

        return $instance;
    }

	public function widget( $args, $instance ) {
		extract( $args );
		
		global $yith_wcwl;

		?>
		<div class="edge-wishlist-widget-holder">
            <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="edge-wishlist-widget-link">
                <span class="edge-wishlist-widget-icon"><i class="icon_heart_alt"></i></span>
                <span class="edge-wishlist-items-number">(<span><?php echo yith_wcwl_count_products(); ?></span>)</span>
            </a>
			<?php wp_nonce_field( 'edgtf_product_wishlist_nonce_' . $unique_id, 'edgtf_product_wishlist_nonce_' . $unique_id ); ?>
		</div>
		<?php
	}
}
?>