<?php
/*
Plugin Name: Edge Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Edge Themes
Version: 1.0.1
*/
define('EDGE_TWITTER_FEED_VERSION', '1.0.1');
define('EDGE_TWITTER_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if ( ! function_exists( 'edge_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function edge_twitter_feed_text_domain() {
		load_plugin_textdomain( 'edge-twitter-feed', false, EDGE_TWITTER_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'edge_twitter_feed_text_domain' );
}