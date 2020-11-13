<div class="edge-membership-dashboard-page">
	<h3 class="edge-membership-dashboard-page-title">
		<?php esc_html_e( 'Edit Profile', 'edge-membership' ); ?>
	</h3>
	<div>
		<form method="post" id="edge-membership-update-profile-form">
			<div class="edge-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'edge-membership' ); ?></label>
				<input class="edge-membership-input" type="text" name="first_name" id="first_name"
				       value="<?php echo esc_attr($first_name); ?>">
			</div>
			<div class="edge-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'edge-membership' ); ?></label>
				<input class="edge-membership-input" type="text" name="last_name" id="last_name"
				       value="<?php echo esc_attr($last_name); ?>">
			</div>
			<div class="edge-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'edge-membership' ); ?></label>
				<input class="edge-membership-input" type="email" name="email" id="email"
				       value="<?php echo esc_attr($email); ?>">
			</div>
			<div class="edge-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'edge-membership' ); ?></label>
				<input class="edge-membership-input" type="text" name="url" id="url" value="<?php echo esc_attr($website); ?>">
			</div>
			<div class="edge-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'edge-membership' ); ?></label>
				<input class="edge-membership-input" type="text" name="description" id="description"
				       value="<?php echo esc_attr($description); ?>">
			</div>
			<div class="edge-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'edge-membership' ); ?></label>
				<input class="edge-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="edge-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'edge-membership' ); ?></label>
				<input class="edge-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<?php
			if ( edge_membership_theme_installed() ) {
				echo adorn_edge_get_button_html( array(
					'text'      => esc_html__( 'UPDATE PROFILE', 'edge-membership' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('UPDATING PROFILE', 'edge-membership'),
						'data-updated-text' => esc_html__('PROFILE UPDATED', 'edge-membership'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'UPDATE PROFILE', 'edge-membership' ) . '</button>';
			}
			wp_nonce_field( 'edge_validate_edit_profile', 'edge_nonce_edit_profile' )
			?>
		</form>
		<?php
		do_action( 'edge_membership_action_login_ajax_response' );
		?>
	</div>
</div>