<div class="edge-fullscreen-search-holder">
    <div class="edge-fullscreen-search-logo edge-logo-wrapper">
        <?php if(!$hide_logo) {
            adorn_edge_get_logo();
        } ?>
    </div>
	<div class="edge-fullscreen-search-close-container">
		<div class="edge-search-close-holder">
			<a class="edge-fullscreen-search-close" href="javascript:void(0)">
				<span class="icon-arrows-remove"></span>
			</a>
		</div>
	</div>
	<div class="edge-fullscreen-search-table">
		<div class="edge-fullscreen-search-cell">
			<div class="edge-fullscreen-search-inner">
				<form action="<?php echo esc_url(home_url('/')); ?>" class="edge-fullscreen-search-form" method="get">
					<div class="edge-form-holder">
						<div class="edge-form-holder-inner">
							<div class="edge-field-holder">
								<input type="text"  placeholder="<?php esc_attr_e('SEARCH HERE', 'adorn'); ?>" name="s" class="edge-search-field" autocomplete="off" />
							</div>
							<button type="submit" class="edge-search-submit"><span class="icon_search "></span></button>
							<div class="edge-line"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>