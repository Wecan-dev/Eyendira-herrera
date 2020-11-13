<?php

if(adorn_edge_is_yith_wishlist_installed()) {
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-conf.php';
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-functions.php';
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-hooks.php';
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/widgets/yith-wishlist.php';
}