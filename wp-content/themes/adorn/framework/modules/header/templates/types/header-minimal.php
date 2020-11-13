<?php do_action('adorn_edge_before_page_header'); ?>

<header class="edge-page-header">
	<?php if($show_fixed_wrapper) : ?>
	<div class="edge-fixed-wrapper">
		<?php endif; ?>
		<div class="edge-menu-area">
			<?php if($menu_area_in_grid) : ?>
			<div class="edge-grid">
				<?php endif; ?>
				<?php do_action('adorn_edge_after_header_menu_area_html_open') ?>
				<div class="edge-vertical-align-containers">
					<div class="edge-position-left">
						<div class="edge-position-left-inner">
							<?php if(!$hide_logo) {
								adorn_edge_get_logo();
							} ?>
						</div>
					</div>
					<div class="edge-position-right">
						<div class="edge-position-right-inner">
							<a href="javascript:void(0)" class="edge-fullscreen-menu-opener">
								<span class="edge-fm-lines">
									<span class="edge-fm-line edge-line-1"></span>
									<span class="edge-fm-line edge-line-2"></span>
									<span class="edge-fm-line edge-line-3"></span>
								</span>
							</a>
						</div>
					</div>
				</div>
				<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
		<?php if($show_fixed_wrapper) : ?>
	</div>
<?php endif; ?>
	<?php if($show_sticky) {
		adorn_edge_get_sticky_header('minimal');
	} ?>
</header>

<?php do_action('adorn_edge_after_page_header'); ?>

