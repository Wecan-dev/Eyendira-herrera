<div class="edge-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="edge-tab-content">
				<h2 class="edge-page-title"><?php esc_html_e('Backup Options', 'adorn'); ?></h2>
				<form method="post" class="edge_ajax_form edge-backup-options-page-holder">
					<div class="edge-page-form">
						<div class="edge-page-form-section-holder">
							<h3 class="edge-page-section-title"><?php esc_html_e('Export/Import Options', 'adorn'); ?></h3>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Export', 'adorn'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control edge-form-element" rows="10" readonly><?php echo edge_core_export_options(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Import', 'adorn'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control edge-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edge-import-theme-options-btn"><?php esc_html_e('Import', 'adorn'); ?></button>
									<?php wp_nonce_field('edge_import_theme_options_secret_value', 'edge_import_theme_options_secret', false); ?>
									<span class="edge-bckp-message"></span>
								</div>
							</div>
							<div class="edge-page-form-section edge-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'adorn') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will overide all your existing options.', 'adorn'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="edge-page-form-section-holder">
							<h3 class="edge-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'adorn'); ?></h3>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Export', 'adorn'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control edge-form-element" rows="10" readonly><?php echo edge_core_export_custom_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Import', 'adorn'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control edge-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edge-import-custom-sidebars-btn"><?php esc_html_e('Import', 'adorn'); ?></button>
									<?php wp_nonce_field('edge_import_custom_sidebars_secret_value', 'edge_import_custom_sidebars_secret', false); ?>
									<span class="edge-bckp-message"></span>
								</div>
							</div>
							<div class="edge-page-form-section edge-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'adorn') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'adorn'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="edge-page-form-section-holder">
							<h3 class="edge-page-section-title"><?php esc_html_e('Export/Import Widgets', 'adorn'); ?></h3>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Export', 'adorn'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control edge-form-element" rows="10" readonly><?php echo edge_core_export_widgets_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Import', 'adorn'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control edge-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edge-import-widgets-btn"><?php esc_html_e('Import', 'adorn'); ?></button>
									<?php wp_nonce_field('edge_import_widgets_secret_value', 'edge_import_widgets_secret', false); ?>
									<span class="edge-bckp-message"></span>
								</div>
							</div>
							<div class="edge-page-form-section edge-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'adorn') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'adorn'); ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>