<?php adorn_edge_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer) { ?>
			<footer class="edge-page-footer">
				<?php
					if($display_footer_top) {
						adorn_edge_get_footer_top();
					}
					if($display_footer_bottom) {
						adorn_edge_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.edge-wrapper-inner  -->
</div> <!-- close div.edge-wrapper -->
<?php wp_footer(); ?>
</body>
</html>