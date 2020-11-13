<div class="edge-social-login-holder">
	<form method="post" class="edge-login-form">
		<?php
		$redirect = '';
		if ( isset( $_GET['redirect_uri'] ) ) {
			$redirect = $_GET['redirect_uri'];
		} ?>
		<fieldset>
			<div>
				<input type="text" name="user_login_name" id="user_login_name" placeholder="<?php esc_attr_e( 'User Name', 'edge-membership' ) ?>" value="" required pattern=".{3,}" title="<?php esc_attr_e( 'Three or more characters', 'edge-membership' ); ?>"/>
			</div>
			<div>
				<input type="password" name="user_login_password" id="user_login_password" placeholder="<?php esc_attr_e( 'Password', 'edge-membership' ) ?>" value="" required/>
			</div>
			<div class="edge-lost-pass-remember-holder clearfix">
				<span class="edge-login-remember">
					<input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
					<label for="rememberme" class="edge-checbox-label"><?php esc_html_e( 'Remember me', 'edge-membership' ) ?></label>
				</span>	
			</div>
			<input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( $redirect ); ?>">
			<div class="edge-login-button-holder">
				<a href="<?php echo wp_lostpassword_url(); ?>" class="edge-login-action-btn" data-el="#edge-reset-pass-content" data-title="<?php esc_attr_e( 'Lost Password?', 'edge-membership' ); ?>"><?php esc_html_e( 'Lost Your password?', 'edge-membership' ); ?></a>
				<?php
				if ( edge_membership_theme_installed() ) {
					echo adorn_edge_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'SIGN IN', 'edge-membership' ),
						'type'      => 'solid',
                        'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'SIGN IN', 'edge-membership' ) . '</button>';
				}
				?>
				<?php wp_nonce_field( 'edge-ajax-login-nonce', 'edge-login-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'edge_membership_action_login_ajax_response' ); ?>
</div>