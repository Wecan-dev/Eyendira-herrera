<?php

if(!function_exists('adorn_edge_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function adorn_edge_get_vc_version() {
		if(adorn_edge_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}