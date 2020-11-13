<?php

class EdgeMembershipLoginRegister extends WP_Widget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'edge_login_register_widget', // Base ID
			'Edge Login',
			array( 'description' => esc_html__( 'Login and register wordpress widget', 'edge-membership' ), )
		);
	}

	public function widget( $args, $instance ) {
		$additional_class = '';
		if(is_user_logged_in()){
			$additional_class .= 'edge-user-logged-in';
		}

		echo '<div class="widget edge-login-register-widget '.$additional_class.'">';
		if ( ! is_user_logged_in() ) {
			echo '<a href="#" class="edge-login-opener">' . esc_html__( 'Sign In', 'edge-membership' ) . '</a>';

			add_action( 'wp_footer', array( $this, 'edge_membership_render_login_form' ) );

		} else {
			echo edge_membership_get_widget_template_part( 'login-widget', 'login-widget-template' );
		}
		echo '</div>';

	}

	public function edge_membership_render_login_form() {

		//Render modal with login and register forms
		echo edge_membership_get_widget_template_part( 'login-widget', 'login-modal-template' );
	}
}

function edge_membership_login_widget_load() {
	register_widget( 'EdgeMembershipLoginRegister' );
}

add_action( 'widgets_init', 'edge_membership_login_widget_load' );