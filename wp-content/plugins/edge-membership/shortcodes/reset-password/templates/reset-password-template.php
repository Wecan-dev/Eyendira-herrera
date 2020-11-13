<div class="edge-social-reset-password-holder">
	<form action="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" method="post" id="edge-lost-password-form" class="edge-reset-pass-form">
		<div>
			<input type="text" name="user_reset_password_login" class="edge-input-field" id="user_reset_password_login" placeholder="<?php esc_attr_e( 'Enter username or email', 'edge-membership' ) ?>" value="" size="20" required>
		</div>
		<?php do_action( 'lostpassword_form' ); ?>
		<div class="edge-reset-password-button-holder">
			<?php
			if ( edge_membership_theme_installed() ) {
				echo adorn_edge_get_button_html( array(
					'html_type' => 'button',
					'text'      => esc_html__( 'NEW PASSWORD', 'edge-membership' ),
					'type'      => 'solid',
					'size'      => 'small'
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'NEW PASSWORD', 'edge-membership' ) . '</button>';
			}
			?>
		</div>
	</form>
	<?php do_action( 'edge_membership_action_login_ajax_response' ); ?>
</div>