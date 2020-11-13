<?php do_action('adorn_edge_before_page_header'); ?>

<header class="edge-page-header">
	<div class="edge-menu-area">
		<?php if($menu_area_in_grid) : ?>
		<div class="edge-grid">
			<?php endif; ?>
			<div class="edge-vertical-align-containers">
				<div class="edge-position-left">
					<div class="edge-position-left-inner">
						<?php adorn_edge_get_main_menu(); ?>
					</div>
				</div>
				<div class="edge-position-right">
					<div class="edge-position-right-inner">
						<?php adorn_edge_get_header_widget_menu_area(); ?>
					</div>
				</div>
			</div>
			<?php if($menu_area_in_grid) : ?>
		</div>
	<?php endif; ?>
        <?php do_action('adorn_edge_end_of_page_header_html'); ?>
	</div>
	<div class="edge-logo-area">
        <?php if($logo_area_in_grid) : ?>
        <div class="edge-grid">
        <?php endif; ?>
            <div class="edge-vertical-align-containers">
                <div class="edge-position-center">
                    <div class="edge-position-center-inner">
                        <?php if(!$hide_logo) {
                            adorn_edge_get_logo();
                        } ?>
                    </div>
                </div>
            </div>
        <?php if($logo_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
</header>

<?php do_action('adorn_edge_after_page_header'); ?>

