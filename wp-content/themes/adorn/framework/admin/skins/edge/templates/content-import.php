<div class="edge-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="edge-tab-content">
				<h2 class="edge-page-title"><?php esc_html_e('Import', 'adorn'); ?></h2>
				<form method="post" class="edge_ajax_form edge-import-page-holder" data-confirm-message="<?php esc_attr_e('Are you sure, you want to import Demo Data now?', 'adorn'); ?>">
					<div class="edge-page-form">
						<div class="edge-page-form-section-holder">
							<h3 class="edge-page-section-title"><?php esc_html_e('Import Demo Content', 'adorn'); ?></h3>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Import', 'adorn'); ?></h4>
									<p><?php esc_html_e('Choose demo content you want to import', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-3">
												<select name="import_example" id="import_example" class="form-control edge-form-element dependence">
													<option value="adorn"><?php esc_html_e('Adorn', 'adorn'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Import Type', 'adorn'); ?></h4>
									<p><?php esc_html_e('Import Type', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-3">
												<select name="import_option" id="import_option" class="form-control edge-form-element">
													<option value=""><?php esc_html_e('Please Select', 'adorn'); ?></option>
													<option value="complete_content"><?php esc_html_e('All', 'adorn'); ?></option>
													<option value="content"><?php esc_html_e('Content', 'adorn'); ?></option>
													<option value="widgets"><?php esc_html_e('Widgets', 'adorn'); ?></option>
													<option value="options"><?php esc_html_e('Options', 'adorn'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<h4><?php esc_html_e('Import attachments', 'adorn'); ?></h4>
									<p><?php esc_html_e('Do you want to import media files?', 'adorn'); ?></p>
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<p class="field switch">
													<label class="cb-enable dependence"><span><?php esc_html_e('Yes', 'adorn'); ?></span></label>
													<label class="cb-disable selected dependence"><span><?php esc_html_e('No', 'adorn'); ?></span></label>
													<input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section">
								<div class="edge-field-desc">
									<input type="submit" class="btn btn-primary btn-sm " value="<?php esc_attr_e('Import', 'adorn'); ?>" name="import" id="edge-import-demo-data" />
								</div>
								<div class="edge-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<div class="edge-import-load"><span><?php esc_html_e('The import process may take some time. Please be patient.', 'adorn') ?> </span><br />
													<div class="edge-progress-bar-wrapper html5-progress-bar">
														<div class="progress-bar-wrapper">
															<progress id="progressbar" value="0" max="100"></progress>
														</div>
														<div class="progress-value">0%</div>
														<div class="progress-bar-message">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edge-page-form-section edge-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'adorn') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will take time needed to download all attachments from demo web site.', 'adorn'); ?></li>
										<li> <?php esc_html_e('If you plan to use shop, please install WooCommerce before you run import.', 'adorn')?></li>
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