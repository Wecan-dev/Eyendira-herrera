<?php
namespace Adorn\Modules\Header\Types;

use Adorn\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Divided layout and option
 *
 * Class HeaderDivided
 */
class HeaderDivided extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;
    protected $mobileHeaderHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-divided';

        if(!is_admin()) {

            $menuAreaHeight       = adorn_edge_filter_px(adorn_edge_options()->getOptionValue('menu_area_height'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? intval($menuAreaHeight) : 96;

            $mobileHeaderHeight       = adorn_edge_filter_px(adorn_edge_options()->getOptionValue('mobile_header_height'));
            $this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? intval($mobileHeaderHeight) : 60;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('adorn_edge_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('adorn_edge_per_page_js_vars', array($this, 'getPerPageJSVariables'));
        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {
        $id  = adorn_edge_get_page_id();

        $parameters['menu_area_in_grid'] = adorn_edge_get_meta_field_intersect('menu_area_in_grid',$id) == 'yes' ? true : false;

        $parameters = apply_filters('adorn_edge_parameters', $parameters);
    
        adorn_edge_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency         = $this->calculateHeightOfTransparency();
        $this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
        $this->headerHeight                 = $this->calculateHeaderHeight();
        $this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $id = adorn_edge_get_page_id();
        $transparencyHeight = 0;

        if(get_post_meta($id, 'edge_menu_area_background_transparency_meta', true) !== '1' && get_post_meta($id, 'edge_menu_area_background_transparency_meta', true) !== ''){
            $menuAreaTransparent = true;
        } else if (adorn_edge_options()->getOptionValue('menu_area_background_transparency') !== '1' && adorn_edge_options()->getOptionValue('menu_area_background_transparency') !== '') {
            $menuAreaTransparent = true;
        } else if (is_404() && adorn_edge_options()->getOptionValue('404_menu_area_background_transparency_header') !== '1' && adorn_edge_options()->getOptionValue('404_menu_area_background_transparency_header') !== '') {
            $menuAreaTransparent = true;
        } else {
            $menuAreaTransparent = false;
        }

		$sliderExists = get_post_meta($id, 'edge_page_slider_meta', true) !== '';

		if($sliderExists) {
			$menuAreaTransparent = true;
		}

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;

			if(($sliderExists && adorn_edge_is_top_bar_enabled())
				|| adorn_edge_is_top_bar_enabled() && adorn_edge_is_top_bar_transparent()
			) {
				$transparencyHeight += adorn_edge_get_top_bar_height();
			}
        }

        return $transparencyHeight;
    }

    /**
     * Returns height of completely transparent header parts
     *
     * @return int
     */
    public function calculateHeightOfCompleteTransparency() {
        $id = adorn_edge_get_page_id();
        $transparencyHeight = 0;

        $menuAreaTransparent = adorn_edge_options()->getOptionValue('fixed_header_transparency') === '0';

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;
        }

        return $transparencyHeight;
    }


    /**
     * Returns total height of header
     *
     * @return int|string
     */
    public function calculateHeaderHeight() {
        $headerHeight = $this->menuAreaHeight;
        if(adorn_edge_is_top_bar_enabled()) {
            $headerHeight += adorn_edge_get_top_bar_height();
        }

        return $headerHeight;
    }

    /**
     * Returns total height of mobile header
     *
     * @return int|string
     */
    public function calculateMobileHeaderHeight() {
        $mobileHeaderHeight = $this->mobileHeaderHeight;

        return $mobileHeaderHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['edgeLogoAreaHeight'] = 0;
        $globalVariables['edgeMenuAreaHeight'] = $this->headerHeight;
        $globalVariables['edgeMobileHeaderHeight'] = $this->mobileHeaderHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {
        //calculate transparency height only if header has no sticky behaviour
        if(!in_array(adorn_edge_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            $perPageVars['edgeHeaderTransparencyHeight'] = $this->headerHeight - (adorn_edge_get_top_bar_height() + $this->heightOfCompleteTransparency);
        } else {
            $perPageVars['edgeHeaderTransparencyHeight'] = 0;
        }

        return $perPageVars;
    }
}