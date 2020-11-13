<?php do_action('adorn_edge_before_mobile_header'); ?>

	<header class="edge-mobile-header">
		<div class="edge-mobile-header-inner">
			<?php do_action('adorn_edge_after_mobile_header_html_open') ?>
			<div class="edge-mobile-header-holder">
				<div class="edge-grid">
					<div class="edge-vertical-align-containers">
						<?php if($show_logo) : ?>
						<div class="edge-position-left">
							<div class="edge-position-left-inner">
								<?php adorn_edge_get_mobile_logo(); ?>
							</div>
						</div>
						<?php endif; ?>
						<div class="edge-position-right">
							<div class="edge-position-right-inner">
								<?php if($show_navigation_opener) : ?>
									<div class="edge-mobile-menu-opener">
										<a href="javascript:void(0)">
											<span class="edge-mo-lines">
												<i class="edge-mo-line"></i>
											</span>
										</a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!-- close .edge-vertical-align-containers -->
				</div>
			</div>
		</div>
		<div class="edge-mobile-side-area">
			<div class="edge-close-mobile-side-area-holder">
				<span aria-hidden="true" class="edge-mo-line"></span>
			</div>
			<div class="edge-mobile-side-area-inner">
				<?php adorn_edge_get_mobile_nav(); ?>
			</div>
			<?php if(is_active_sidebar('edge-mobile-menu-bottom')) {
				dynamic_sidebar('edge-mobile-menu-bottom');
			} ?>
		</div>
	</header> <!-- close .edge-mobile-header -->

<?php do_action('adorn_edge_after_mobile_header'); ?>