<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class EdgeSkin extends AdornEdgeSkinAbstract {
    /**
     * Skin constructor. Hooks to adorn_edge_admin_scripts_init and adorn_edge_enqueue_admin_styles
     */
    public function __construct() {
        $this->skinName = 'edge';

        //hook to
        add_action('adorn_edge_admin_scripts_init', array($this, 'registerStyles'));
        add_action('adorn_edge_admin_scripts_init', array($this, 'registerScripts'));

        add_action('adorn_edge_enqueue_admin_styles', array($this, 'enqueueStyles'));
        add_action('adorn_edge_enqueue_admin_scripts', array($this, 'enqueueScripts'));

        add_action('adorn_edge_enqueue_meta_box_styles', array($this, 'enqueueStyles'));
        add_action('adorn_edge_enqueue_meta_box_scripts', array($this, 'enqueueScripts'));

		add_action( 'admin_enqueue_scripts', array( $this, 'setShortcodeJSParams' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have

		$this->setIcons();
		$this->setMenuItemPosition();
    }

    /**
     * Method that registers skin scripts
     */
    public function registerScripts() {
        $this->scripts['bootstrap.min'] = 'assets/js/bootstrap.min.js';
        $this->scripts['jquery.nouislider.min'] = 'assets/js/edge-ui/jquery.nouislider.min.js';
        $this->scripts['edge-ui-admin'] = 'assets/js/edge-ui/edge-ui.js';
        $this->scripts['edge-bootstrap-select'] = 'assets/js/edge-ui/edge-bootstrap-select.min.js';

        foreach ($this->scripts as $scriptHandle => $scriptPath) {
            adorn_edge_register_skin_script($scriptHandle, $scriptPath);
        }
    }

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
        $this->styles['edge-bootstrap'] = 'assets/css/edge-bootstrap.css';
        $this->styles['edge-page-admin'] = 'assets/css/edge-page.css';
        $this->styles['edge-options-admin'] = 'assets/css/edge-options.css';
        $this->styles['edge-meta-boxes-admin'] = 'assets/css/edge-meta-boxes.css';
        $this->styles['edge-ui-admin'] = 'assets/css/edge-ui/edge-ui.css';
        $this->styles['edge-forms-admin'] = 'assets/css/edge-forms.css';
        $this->styles['edge-import'] = 'assets/css/edge-import.css';
        $this->styles['font-awesome-admin'] = 'assets/css/font-awesome/css/font-awesome.min.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            adorn_edge_register_skin_style($styleHandle, $stylePath);
        }
    }

	/**
	 * Method that set menu icons
	 */
	public function setIcons() {
		$this->icons = array(
			'slider' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
            'slider-lite' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'carousel' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'testimonial' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'portfolio' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'team' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'masonry-gallery' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'options' => 'dashicons-admin-generic'
		);
	}

	/**
	 * Method that set menu item position
	 */
	public function setMenuItemPosition() {
		$this->itemPosition = array(
			'carousel' => 4,
			'testimonial' => 4,
			'portfolio' => 4,
			'team' => 4,
			'masonry-gallery' => 4,
			'options' => 1000
		);
	}
	
	/**
	 * Method that renders options page
	 *
	 * @see EdgeSkin::getHeader()
	 * @see EdgeSkin::getPageNav()
	 * @see EdgeSkin::getPageContent()
	 */
	public function renderOptions() {
		global $adorn_Framework;
		$tab    = adorn_edge_get_admin_tab();
		$active_page = $adorn_Framework->edgeOptions->getAdminPageFromSlug($tab);
		if ($active_page == null) return;
		?>
		<div class="edge-options-page edge-page">
			<?php $this->getHeader($active_page); ?>
			<div class="edge-page-content-wrapper">
				<div class="edge-page-content">
					<div class="edge-page-navigation edge-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav($tab); ?>
						<?php $this->getPageContent($active_page); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
	
	/**
	 * Method that renders header of options page.
	 * @param bool $show_save_btn whether to show save button. Should be hidden on import page
	 *
	 * @see EdgeSkinAbstract::loadTemplatePart()
	 */
	public function getHeader($activePage = '', $show_save_btn = true) {
		$this->loadTemplatePart('header', array('active_page' => $activePage, 'show_save_btn' => $show_save_btn));
	}
	
	/**
	 * Method that loads page navigation
	 * @param string $tab current tab
	 * @param bool $is_import_page if is import page highlighted that tab
	 *
	 * @see EdgeSkinAbstract::loadTemplatePart()
	 */
	public function getPageNav($tab, $is_import_page = false, $is_backup_options_page = false) {
		$this->loadTemplatePart('navigation', array(
			'tab' => $tab,
			'is_import_page' => $is_import_page,
			'is_backup_options_page' => $is_backup_options_page
		));
	}
	
	/**
	 * Method that loads current page content
	 *
	 * @param MaisonPhpClassAdminPage $page current page to load
	 * @see EdgeSkinAbstract::loadTemplatePart()
	 */
	public function getPageContent($page) {
		$this->loadTemplatePart('content', array('page' => $page));
	}
	
	/**
	 * Method that loads content for import page
	 */
	public function getImportContent() {
		$this->loadTemplatePart('content-import');
	}
	
	/**
	 * Method that loads content for backup page
	 */
	public function getBackupOptionsContent() {
		$this->loadTemplatePart('backup-options');
	}
	
	/**
	 * Method that loads anchors and save button template part
	 *
	 * @param MaisonPhpClassAdminPage $page current page to load
	 * @see EdgeSkinAbstract::loadTemplatePart()
	 */
	public function getAnchors($page) {
		$this->loadTemplatePart('anchors', array('page' => $page));
		
	}
	
	/**
	 * Method that renders import page
	 *
	 *  @see EdgeSkin::getHeader()
	 *  @see EdgeSkin::getPageNav()
	 *  @see EdgeSkin::getImportContent()
	 */
	public function renderImport() { ?>
		<div class="edge-options-page edge-page">
			<?php $this->getHeader('', false); ?>
			<div class="edge-page-content-wrapper">
				<div class="edge-page-content">
					<div class="edge-page-navigation edge-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('tabimport', true); ?>
						<?php $this->getImportContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
	
	/**
	 * Method that renders backup options page
	 *
	 * @see SelectSkin::getHeader()
	 * * @see SelectSkin::getPageNav()
	 * * @see SelectSkin::getImportContent()
	 */
	public function renderBackupOptions() { ?>
		<div class="edge-options-page edge-page">
			<?php $this->getHeader('',false); ?>
			<div class="edge-page-content-wrapper">
				<div class="edge-page-content">
					<div class="edge-page-navigation edge-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('backup_options', false, true); ?>
						<?php $this->getBackupOptionsContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
}
?>