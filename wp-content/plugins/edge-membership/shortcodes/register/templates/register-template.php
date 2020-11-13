<div class="edge-social-register-holder">
	<form method="post" class="edge-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name"
				       placeholder="<?php esc_attr_e( 'User Name', 'edge-membership' ) ?>" value="" required
				       pattern=".{3,}"
				       title="<?php esc_attr_e( 'Three or more characters', 'edge-membership' ); ?>"/>
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email"
				       placeholder="<?php esc_attr_e( 'Email', 'edge-membership' ) ?>" value="" required/>
			</div>
            <div>
                <input type="password" name="user_register_password" id="user_register_password"
                       placeholder="<?php esc_attr_e('Password', 'edge-membership') ?>" value="" required/>
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password"
                       placeholder="<?php esc_attr_e('Repeat Password', 'edge-membership') ?>" value="" required/>
            </div>
			<div class="edge-register-button-holder">
				<?php
				if ( edge_membership_theme_installed() ) {
					echo adorn_edge_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'REGISTER', 'edge-membership' ),
						'type'      => 'solid',
						'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'REGISTER', 'edge-membership' ) . '</button>';
				}
				wp_nonce_field( 'edge-ajax-register-nonce', 'edge-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'edge_membership_action_login_ajax_response' ); ?>
</div>