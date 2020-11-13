<?php ?>
<form action="<?php echo esc_url(home_url('/')); ?>" class="edge-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
		<div class="edge-container">
			<div class="edge-container-inner clearfix">
				<?php } ?>
					<div class="form-inner">
						<i class="fa fa-search"></i>
						<input type="text" placeholder="<?php esc_attr_e('Search', 'adorn'); ?>" name="s" class="edge-search-field" autocomplete="off" />
						<input type="submit" value="<?php esc_attr_e('Search', 'adorn'); ?>" />
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
				<?php if ( $search_in_grid ) { ?>
			</div>
		</div>
	<?php } ?>
</form>