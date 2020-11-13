<?php if($query_results->max_num_pages > 1) { ?>
	<div class="edge-pl-loading">
		<div class="edge-pl-loading-bounce1"></div>
		<div class="edge-pl-loading-bounce2"></div>
		<div class="edge-pl-loading-bounce3"></div>
	</div>
	<?php
		$pages = $query_results->max_num_pages;
		$paged = $query_results->query['paged'];
		
		if($pages > 1){ ?>
			<div class="edge-pl-standard-pagination">
				<ul>
					<li class="edge-pl-pag-prev">
						<a href="#" data-paged="1"><span class="edge-icon-shortcode edge-normal">
                    <i class="edge-icon-linear-icon lnr lnr-arrow-left edge-icon-element" style=""></i></span></a>
					</li>
					<?php for ($i=1; $i <= $pages; $i++) { ?>
						<?php
							$active_class = '';
							if($paged == $i) {
								$active_class = 'edge-pl-pag-active';
							}
						?>
						<li class="edge-pl-pag-number <?php echo esc_attr($active_class); ?>">
							<a href="#" data-paged="<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></a>
						</li>
					<?php } ?>
					<li class="edge-pl-pag-next">
						<a href="#" data-paged="2"><span class="edge-icon-shortcode edge-normal">
                        <i class="edge-icon-linear-icon lnr lnr-arrow-right edge-icon-element" style=""></i></span></a>
					</li>
				</ul>
			</div>
		<?php }
	?>
<?php }