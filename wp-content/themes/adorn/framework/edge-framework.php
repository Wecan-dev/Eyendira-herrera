<?php

require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.kses.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.layout1.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.layout2.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.layout3.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.optionsapi.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.framework.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.functions.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edge.icons/edge.icons.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/admin/options/edge-options-setup.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/admin/meta-boxes/edge-meta-boxes-setup.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/modules/edge-modules-loader.php";

if(!function_exists('adorn_edge_admin_scripts_init')) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function adorn_edge_admin_scripts_init() {

        /**
         * @see EdgeSkinAbstract::registerScripts - hooked with 10
         * @see EdgeSkinAbstract::registerStyles - hooked with 10
         */
        do_action('adorn_edge_admin_scripts_init');
	}

	add_action('admin_init', 'adorn_edge_admin_scripts_init');
}

if(!function_exists('adorn_edge_enqueue_admin_styles')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function adorn_edge_enqueue_admin_styles() {
		wp_enqueue_style('wp-color-picker');

        /**
         * @see EdgeSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('adorn_edge_enqueue_admin_styles');
	}
}

if(!function_exists('adorn_edge_enqueue_admin_scripts')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function adorn_edge_enqueue_admin_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script("edge-dependence", get_template_directory_uri().'/framework/admin/assets/js/edge-ui/edge-dependence.js', array(), false, true);
        wp_enqueue_script("edge-twitter-connect", get_template_directory_uri().'/framework/admin/assets/js/edge-twitter-connect.js', array(), false, true);

        /**
         * @see EdgeSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('adorn_edge_enqueue_admin_scripts');
	}
}

if(!function_exists('adorn_edge_enqueue_meta_box_styles')) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function adorn_edge_enqueue_meta_box_styles() {
        global $post;
		wp_enqueue_style( 'wp-color-picker' );
        if($post->post_type == 'team-member'){
            wp_enqueue_style("edge-jquery-ui", get_template_directory_uri().'/framework/admin/assets/css/jquery-ui/jquery-ui.css');
        }

        /**
         * @see EdgeSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('adorn_edge_enqueue_meta_box_styles');
	}
}

if(!function_exists('adorn_edge_enqueue_meta_box_scripts')) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function adorn_edge_enqueue_meta_box_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script('edge-dependence');

        /**
         * @see EdgeSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('adorn_edge_enqueue_meta_box_scripts');
	}
}

if(!function_exists('adorn_edge_enqueue_nav_menu_script')) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 * @param $hook string current page hook to check
	 */
	function adorn_edge_enqueue_nav_menu_script($hook) {
		if($hook == 'nav-menus.php') {
			wp_enqueue_script('edge-nav-menu', get_template_directory_uri().'/framework/admin/assets/js/edge-nav-menu.js');
			wp_enqueue_style('edge-nav-menu', get_template_directory_uri().'/framework/admin/assets/css/edge-nav-menu.css');
		}
	}

	add_action('admin_enqueue_scripts', 'adorn_edge_enqueue_nav_menu_script');
}

if(!function_exists('adorn_edge_enqueue_widgets_admin_script')) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 * @param $hook string current page hook to check
	 */
	function adorn_edge_enqueue_widgets_admin_script($hook) {
		if($hook == 'widgets.php') {
			wp_enqueue_script('edge-dependence');
		}
	}

	add_action('admin_enqueue_scripts', 'adorn_edge_enqueue_widgets_admin_script');
}

if(!function_exists('adorn_edge_enqueue_styles_slider_taxonomy')) {
	/**
	 * Enqueue styles when on slider taxonomy page in admin
	 */
	function adorn_edge_enqueue_styles_slider_taxonomy() {
		if(isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'slides_category') {
			adorn_edge_enqueue_admin_styles();
		}
	}

	add_action('admin_print_scripts-edit-tags.php', 'adorn_edge_enqueue_styles_slider_taxonomy');
}

if(!function_exists('adorn_edge_init_theme_options_array')) {
	/**
	 * Function that merges $adorn_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function adorn_edge_init_theme_options_array() {
        global $adorn_options, $adorn_Framework;

		$db_options = get_option('edge_options_adorn');

		//does edge_options exists in db?
		if(is_array($db_options)) {
			//merge with default options
			$adorn_options  = array_merge($adorn_Framework->edgeOptions->options, get_option('edge_options_adorn'));
		} else {
			//options don't exists in db, take default ones
			$adorn_options = $adorn_Framework->edgeOptions->options;
		}
	}

	add_action('adorn_edge_after_options_map', 'adorn_edge_init_theme_options_array', 0);
}

if(!function_exists('adorn_edge_init_theme_options')) {
	/**
	 * Function that sets $adorn_options variable if it does'nt exists
	 */
	function adorn_edge_init_theme_options() {
		global $adorn_options;
		global $adorn_Framework;
		if(isset($adorn_options['reset_to_defaults'])) {
			if( $adorn_options['reset_to_defaults'] == 'yes' ) delete_option( "edge_options_adorn");
		}

		if (!get_option("edge_options_adorn")) {
			add_option( "edge_options_adorn",
				$adorn_Framework->edgeOptions->options
			);

			$adorn_options = $adorn_Framework->edgeOptions->options;
		}
	}
}

if(!function_exists('adorn_edge_register_theme_settings')) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function adorn_edge_register_theme_settings() {
		register_setting( 'adorn_edge_theme_menu', 'edge_options' );
	}

	add_action('admin_init', 'adorn_edge_register_theme_settings');
}

if(!function_exists('adorn_edge_get_admin_tab')) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function adorn_edge_get_admin_tab(){
		return isset($_GET['page']) ? adorn_edge_strafter($_GET['page'],'tab') : NULL;
	}
}

if(!function_exists('adorn_edge_strafter')) {
	/**
	 * Function that returns string that comes after found string
	 * @param $string string where to search
	 * @param $substring string what to search for
	 * @return null|string string that comes after found string
	 */
	function adorn_edge_strafter($string, $substring) {
		$pos = strpos($string, $substring);
		if ($pos === false) {
			return NULL;
		}

		return(substr($string, $pos+strlen($substring)));
	}
}

if(!function_exists('adorn_edge_save_options')) {
	/**
	 * Function that saves theme options to db.
	 */
	function adorn_edge_save_options() {
		global $adorn_options;

		if(current_user_can('administrator')) {

			$_REQUEST = stripslashes_deep($_REQUEST);

	        unset($_REQUEST['action']);

			check_ajax_referer('edge_ajax_save_nonce', 'edge_ajax_save_nonce');

			$adorn_options = array_merge($adorn_options, $_REQUEST);

			update_option( 'edge_options_adorn', $adorn_options );

			do_action('adorn_edge_after_theme_option_save');
			echo "Saved";

			die();
		}
	}

	add_action('wp_ajax_adorn_edge_save_options', 'adorn_edge_save_options');
}

if(!function_exists('adorn_edge_meta_box_add')) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function adorn_edge_meta_box_add() {
		global $adorn_Framework;
		
		foreach ($adorn_Framework->edgeMetaBoxes->metaBoxes as $key=>$box ) {
			$hidden = false;
			if (!empty($box->hidden_property)) {
				foreach ($box->hidden_values as $value) {
					if (adorn_edge_option_get_value($box->hidden_property) == $value) {
						$hidden = true;
					}
				}
			}

			if(is_string($box->scope)) {
				$box->scope = array($box->scope);
			}

			if(is_array($box->scope) && count($box->scope)) {
				foreach($box->scope as $screen) {
					adorn_edge_create_meta_box_handler( $box, $key, $screen );

					if ($hidden) {
						add_filter('postbox_classes_'.$screen.'_edge-meta-box-'.$key, 'adorn_edge_meta_box_add_hidden_class');
					}
				}
			}
		}

		if ( adorn_edge_is_plugin_installed( 'gutenberg-editor' ) || adorn_edge_is_plugin_installed( 'gutenberg-plugin' ) ) {
			adorn_edge_enqueue_meta_box_styles();
			adorn_edge_enqueue_meta_box_scripts();
		} else {
			add_action('admin_enqueue_scripts', 'adorn_edge_enqueue_meta_box_styles');
			add_action('admin_enqueue_scripts', 'adorn_edge_enqueue_meta_box_scripts');
		}
	}
}

if(!function_exists('adorn_edge_meta_box_save')) {
	/**
	 * Function that saves meta box to postmeta table
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function adorn_edge_meta_box_save( $post_id, $post ) {
		global $adorn_Framework;
		global $adorn_IconCollections;

		$nonces_array = array();
		$meta_boxes = adorn_edge_framework()->edgeMetaBoxes->getMetaBoxesByScope($post->post_type);

		if(is_array($meta_boxes) && count($meta_boxes)) {
			foreach($meta_boxes as $meta_box) {
				$nonces_array[] = 'adorn_edge_meta_box_'.$meta_box->name.'_save';
			}
		}

		if(is_array($nonces_array) && count($nonces_array)) {
			foreach($nonces_array as $nonce) {
				if(!isset($_POST[$nonce]) || !wp_verify_nonce($_POST[$nonce], $nonce)) {
					return;
				}
			}
		}
		
		$postTypes = apply_filters('adorn_edge_meta_box_post_types_save', array('post', 'page'));

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!isset( $_POST[ '_wpnonce' ])) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (!in_array($post->post_type, $postTypes)) {
			return;
		}

		foreach ($adorn_Framework->edgeMetaBoxes->options as $key=>$box ) {

			if (isset($_POST[$key]) && trim($_POST[$key] !== '')) {

				$value = $_POST[$key];

				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}

		$portfolios = false;
		if (isset($_POST['optionLabel'])) {
			foreach ($_POST['optionLabel'] as $key => $value) {
				$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]);
				$portfolios = true;

			}
		}

		if ($portfolios) {
			update_post_meta( $post_id,  'edge_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'edge_portfolios' );
		}

		$portfolio_images = false;
		if (isset($_POST['portfolioimg'])) {
			foreach ($_POST['portfolioimg'] as $key => $value) {
				$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key], 'portfoliovideoimage'=>$_POST['portfoliovideoimage'][$key], 'portfoliovideowebm'=>$_POST['portfoliovideowebm'][$key], 'portfoliovideomp4'=>$_POST['portfoliovideomp4'][$key], 'portfoliovideoogv'=>$_POST['portfoliovideoogv'][$key], 'portfolioimgtype'=>$_POST['portfolioimgtype'][$key] );
				$portfolio_images = true;
			}
		}

		if ($portfolio_images) {
			update_post_meta( $post_id,  'edge_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id,  'edge_portfolio_images' );
		}
	}

	add_action( 'save_post', 'adorn_edge_meta_box_save', 1, 2 );
}

if(!function_exists('adorn_edge_render_meta_box')) {
	/**
	 * Function that renders meta box
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function adorn_edge_render_meta_box($post, $metabox) {?>
		<div class="edge-meta-box edge-page">
			<div class="edge-meta-box-holder">
				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field('adorn_edge_meta_box_'.$metabox['args']['box']->name.'_save', 'adorn_edge_meta_box_'.$metabox['args']['box']->name.'_save'); ?>
			</div>
		</div>
	<?php
	}
}

if(!function_exists('adorn_edge_meta_box_add_hidden_class')) {
	/**
	 * Function that adds class that will initially hide meta box
	 * @param array $classes array of classes
	 * @return array modified array of classes
	 */
	function adorn_edge_meta_box_add_hidden_class( $classes=array() ) {
		if( !in_array( 'edge-meta-box-hidden', $classes ) )
			$classes[] = 'edge-meta-box-hidden';

		return $classes;
	}
}

if(!function_exists('adorn_edge_remove_default_custom_fields')) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function adorn_edge_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( apply_filters('adorn_edge_meta_box_post_types_remove', array( 'post', 'page')) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action('do_meta_boxes', 'adorn_edge_remove_default_custom_fields');
}

if(!function_exists('adorn_edge_generate_icon_pack_options')) {
    /**
     * Generates options HTML for each icon in given icon pack
     */
    function adorn_edge_generate_icon_pack_options() {
		check_ajax_referer( 'update-nav_menu', 'update_nav_menu_nonce' );

        global $adorn_IconCollections;

        $html = '';
        $icon_pack = isset($_POST['icon_pack']) ? $_POST['icon_pack'] : '';
        $collections_object = $adorn_IconCollections->getIconCollection($icon_pack);

        if($collections_object) {
            $icons = $collections_object->getIconsArray();
            if(is_array($icons) && count($icons)) {
                foreach ($icons as $key => $icon) {
                    $html .= '<option value="'.esc_attr($key).'">'.esc_html($key).'</option>';
                }
            }
        }

	    echo wp_kses($html, array('option' => array('value' => true)));
    }

    add_action('wp_ajax_update_admin_nav_icon_options', 'adorn_edge_generate_icon_pack_options');
}

if(!function_exists('adorn_edge_admin_notice')) {
    /**
     * Prints admin notice. It checks if notice has been disabled and if it hasn't then it displays it
     * @param $id string id of notice. It will be used to store notice dismis
     * @param $message string message to show to the user
     * @param $class string HTML class of notice
     * @param bool $is_dismisable whether notice is dismisable or not
     */
    function adorn_edge_admin_notice($id, $message, $class, $is_dismisable = true) {
        $is_dismised = get_user_meta(get_current_user_id(), 'dismis_'.$id);

        //if notice isn't dismissed
        if(!$is_dismised && is_admin()) {
            echo '<div style="display: block;" class="'.esc_attr($class).' is-dismissible notice">';
            echo '<p>';

            echo wp_kses_post($message);

            if($is_dismisable) {
                echo '<strong style="display: block; margin-top: 7px;"><a href="'.esc_url(add_query_arg('edge_dismis_notice', $id)).'">'.esc_html__('Dismiss this notice', 'adorn').'</a></strong>';
            }

            echo '</p>';
            echo '</div>';
        }
    }
}

if(!function_exists('adorn_edge_save_dismisable_notice')) {
    /**
     * Updates user meta with dismisable notice. Hooks to admin_init action
     * in order to check this on every page request in admin
     */
    function adorn_edge_save_dismisable_notice() {
        if(is_admin() && !empty($_GET['edge_dismis_notice'])) {
            $notice_id = sanitize_key($_GET['edge_dismis_notice']);
            $current_user_id = get_current_user_id();

            update_user_meta($current_user_id, 'dismis_'.$notice_id, 1);
        }
    }

    add_action('admin_init', 'adorn_edge_save_dismisable_notice');
}

if(!function_exists('adorn_edge_hook_twitter_request_ajax')) {
    /**
     * Wrapper function for obtaining twitter request token.
     *
     * @see EdgeTwitterApi::obtainRequestToken()
     */
    function adorn_edge_hook_twitter_request_ajax() {
		check_ajax_referer( 'edgtf_twitter_connect_nonce', 'twitter_connect_nonce' );
		
        EdgeTwitterApi::getInstance()->obtainRequestToken();
    }

    add_action('wp_ajax_edge_twitter_obtain_request_token', 'adorn_edge_hook_twitter_request_ajax');
}

if (!function_exists('adorn_edge_comment')) {
    /**
     * Function which modify default wordpress comments
     *
     * @return comments html
     */
    function adorn_edge_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        global $post;

        $is_pingback_comment = $comment->comment_type == 'pingback';
        $is_author_comment  = $post->post_author == $comment->user_id;

        $comment_class = 'edge-comment clearfix';

        if($is_author_comment) {
            $comment_class .= ' edge-post-author-comment';
        }

        if($is_pingback_comment) {
            $comment_class .= ' edge-pingback-comment';
        }
        ?>

        <li>
        <div class="<?php echo esc_attr($comment_class); ?>">
            <?php if(!$is_pingback_comment) { ?>
                <div class="edge-comment-image"> <?php echo adorn_edge_kses_img(get_avatar($comment, 'thumbnail')); ?> </div>
            <?php } ?>
            <div class="edge-comment-text">
                <div class="edge-comment-info">
                    <h4 class="edge-comment-name">
                        <?php if($is_pingback_comment) { esc_html_e('Pingback:', 'adorn'); } ?>
                        <?php echo wp_kses_post(get_comment_author_link()); ?><span class="edge-comment-time-difference"><?php printf( esc_html__( '%s ago', 'adorn' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
                    </h4>
                    <?php edit_comment_link(esc_html__('edit','adorn')); ?>
                    <span class="edge-comment-reply"><?php comment_reply_link( array_merge( $args, array('reply_text' => esc_html__('reply', 'adorn'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
                </div>
                <?php if(!$is_pingback_comment) { ?>
                    <div class="edge-text-holder" id="comment-<?php echo comment_ID(); ?>">
                        <?php comment_text(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php //li tag will be closed by WordPress after looping through child elements ?>
        <?php
    }
}
?>