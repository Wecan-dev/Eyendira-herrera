<div class="edge-login-register-holder">
	<div class="edge-login-register-content">
		<ul>
			<li><a href="#edge-login-content"><?php esc_html_e( 'Login', 'edge-membership' ); ?></a></li>
			<li><a href="#edge-register-content"><?php esc_html_e( 'Register', 'edge-membership' ); ?></a></li>
		</ul>
		<div class="edge-login-content-inner" id="edge-login-content">
			<div class="edge-wp-login-holder"><?php echo edge_membership_execute_shortcode( 'edge_user_login', array() ); ?></div>
		</div>
		<div class="edge-register-content-inner" id="edge-register-content">
			<div class="edge-wp-register-holder"><?php echo edge_membership_execute_shortcode( 'edge_user_register', array() ) ?></div>
		</div>
	</div>
</div>