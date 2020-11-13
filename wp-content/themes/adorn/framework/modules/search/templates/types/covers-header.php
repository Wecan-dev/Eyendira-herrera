<form action="<?php echo esc_url(home_url('/')); ?>" class="edge-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="edge-container">
		<div class="edge-container-inner clearfix">
			<?php } ?>
			<div class="edge-form-holder-outer">
				<div class="edge-form-holder">
					<div class="edge-form-holder-inner">
						<input type="text" placeholder="<?php esc_attr_e('Search', 'adorn'); ?>" name="s" class="edge_search_field" autocomplete="off" />
						<div class="edge-search-close">
							<a href="#">
								<?php echo wp_kses( $search_icon_close, array(
									'span' => array(
										'aria-hidden' => true,
										'class'       => true
									),
									'i'    => array(
										'class' => true
									)
								) ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>