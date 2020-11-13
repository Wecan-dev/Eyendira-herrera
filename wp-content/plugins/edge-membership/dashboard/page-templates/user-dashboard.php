<?php
get_header();
if ( edge_membership_theme_installed() ) {
	adorn_edge_get_title();
} else { ?>
	<div class="edge-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
?>
	<div class="edge-container">
		<?php do_action( 'adorn_edge_after_container_open' ); ?>
		<div class="edge-container-inner clearfix">
			<?php if ( is_user_logged_in() ) { ?>
				<div class="edge-membership-dashboard-nav-holder clearfix">
					<?php
					//Include dashboard navigation
					echo edge_membership_get_dashboard_template_part( 'navigation' );
					?>
				</div>
				<div class="edge-membership-dashboard-content-holder">
					<?php echo edge_membership_get_dashboard_pages(); ?>
				</div>
			<?php } else { ?>
				<div class="edge-login-register-content edge-user-not-logged-in">
					<ul>
						<li>
							<a href="#edge-login-content"><?php esc_html_e( 'Login', 'edge-membership' ); ?></a>
						</li>
						<li>
							<a href="#edge-register-content"><?php esc_html_e( 'Register', 'edge-membership' ); ?></a>
						</li>
						<li>
							<a href="#edge-reset-pass-content"><?php esc_html_e( 'Reset Password', 'edge-membership' ); ?></a>
						</li>
					</ul>
					<div class="edge-login-content-inner" id="edge-login-content">
						<div
							class="edge-wp-login-holder"><?php echo edge_membership_execute_shortcode( 'edge_user_login', array() ); ?>
						</div>
					</div>
					<div class="edge-register-content-inner" id="edge-register-content">
						<div
							class="edge-wp-register-holder"><?php echo edge_membership_execute_shortcode( 'edge_user_register', array() ) ?>
						</div>
					</div>
					<div class="edge-reset-pass-content-inner" id="edge-reset-pass-content">
						<div
							class="edge-wp-reset-pass-holder"><?php echo edge_membership_execute_shortcode( 'edge_user_reset_password', array() ) ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php do_action( 'adorn_edge_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>