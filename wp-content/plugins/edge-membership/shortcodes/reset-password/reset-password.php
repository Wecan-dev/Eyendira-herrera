<?php
namespace EdgeMembership\Shortcodes\EdgeUserResetPassword;

use EdgeMembership\Lib\ShortcodeInterface;
/**
 * Class EdgeUserResetPassword
 */
class EdgeUserResetPassword implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edge_user_reset_password';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map
	 */
	public function vcMap() {
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {

		$args = array();

		$params = shortcode_atts( $args, $atts );
		extract( $params );

		$html = edge_membership_get_shortcode_template_part( 'reset-password', 'reset-password-template', '', $params );

		return $html;
	}

}