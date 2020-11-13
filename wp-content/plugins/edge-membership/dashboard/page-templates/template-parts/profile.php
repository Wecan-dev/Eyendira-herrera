<div class="edge-membership-dashboard-page">
	<h3 class="edge-membership-dashboard-page-title">
		<?php esc_html_e( 'Profile', 'edge-membership' ); ?>
	</h3>
	<div class="edge-membership-dashboard-page-content">
		<div class="edge-profile-image">
            <?php echo edge_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First Name', 'edge-membership' ); ?>:</span>
			<?php echo esc_html($first_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'edge-membership' ); ?>:</span>
			<?php echo esc_html($last_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'edge-membership' ); ?>:</span>
			<?php echo esc_html($email); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'edge-membership' ); ?>:</span>
			<?php echo esc_html($description); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'edge-membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_html( $website ); ?></a>
		</p>
	</div>
</div>
