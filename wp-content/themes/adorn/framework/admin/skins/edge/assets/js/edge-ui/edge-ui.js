(function($){
	'use strict';

	var $portfolio_image;
	var $thumbs_wrap;
	var $input_gallery_items;
	var $portfolio_item;
	var $portfolio_videos;
	var hidden_elements_array;
	var shown_elements_array;
	var $slide_element;

	$(document).ready(function() {
		//plugins init goes here
		edgeInitSelectChange();
		edgeInitSwitch();
		edgeInitTooltips();
		edgeInitColorpicker();
		edgeInitRangeSlider();
		edgeInitMediaUploader();
		edgeInitGalleryUploader();
		if ($('.edge-page-form').length > 0) {
			edgeInitAjaxForm();
			edgeAnchorSelectOnLoad();
			edgeScrollToAnchorSelect();
			initTopAnchorHolderSize();
			edgeCheckVisibilityOfAnchorButtons();
			edgeCheckVisibilityOfAnchorOptions();
			edgeCheckAnchorsOnDependencyChange();
			edgeCheckOptionAnchorsOnDependencyChange();
			edgeChangedInput();
			edgeFixHeaderAndTitle();
			totop_button();
			backButtonShowHide();
			backToTop();
			edgeInitSelectPicker();
		}
		edgeShowHidePostFormats();
		edgeInitPortfolioImagesVideosBox();
		edgeInitPortfolioMediaAcc();
		edgeInitPortfolioItemsBox();
		edgeInitPortfolioItemAcc();
		edgeInitSlideElementItemAcc();
		edgeInitSlideElementItemsBox();
		edgeInitDatePicker();
		edgePageTemplatesMetaBoxDependency();
		edgeRepeater();
		edgeInitSortable();
		edgeImportOptions();
		edgeImportCustomSidebars();
		edgeImportWidgets();
		edgeInitImportContent();
	});

	$(window).load(function () {
		edgeShowHidePostFormatsGutenberg();
	});
	
	function edgeFixHeaderAndTitle () {
		var pageHeader 				= $('.edge-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
		var pageTitle				= $('.edge-page-title');
		var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
		var tabsNavWrapper			= $('.edge-tabs-navigation-wrapper');
		var tabsNavWrapperTop		= pageHeaderHeight;
		var tabsContentWrapper	    = $('.edge-tab-content');
		var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();
		
		$(window).on('scroll load', function() {
			if($(window).scrollTop() >= pageHeaderTopPosition) {
				pageHeader.addClass('edgt-header-fixed').css('top', parseInt(adminBarHeight));
				pageTitle.addClass('edgt-page-title-fixed').css('top', pageTitleTopPosition);
				tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
				tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
			} else {
				pageHeader.removeClass('edgt-header-fixed').css('top', 0);
				pageTitle.removeClass('edgt-page-title-fixed').css('top', 0);
				tabsNavWrapper.css('marginTop', 0);
				tabsContentWrapper.css('marginTop', 0);
			}
		});
	}
	
	function initTopAnchorHolderSize() {
		function initTopSize() {
			var optionsPageHolder = $('.edge-options-page');
			var anchorAndSaveHolder = $('.edge-top-section-holder');
			var pageTitle = $('.edge-page-title');
			var tabsContentWrapper = $('.edge-tabs-content');
			
			anchorAndSaveHolder.css('width', optionsPageHolder.width() - parseInt(anchorAndSaveHolder.css('margin-left')));
			pageTitle.css('width', tabsContentWrapper.outerWidth());
		}
		
		initTopSize();
		
		$(window).on('resize', function() {
			initTopSize();
		});
	}
	
	function edgeScrollToAnchorSelect() {
		var selectAnchor = $('#edge-select-anchor');
		selectAnchor.on('change', function() {
			var selectAnchor = $('option:selected', selectAnchor);
			if(typeof selectAnchor.data('anchor') !== 'undefined') {
				edgeScrollToPanel(selectAnchor.data('anchor'));
			}
		});
	}
	
	function edgeAnchorSelectOnLoad() {
		var currentPanel = window.location.hash;
		if(currentPanel) {
			var selectAnchor = $('#edge-select-anchor');
			var currentOption = selectAnchor.find('option[data-anchor="'+currentPanel+'"]').first();
			
			if(currentOption) {
				currentOption.attr('selected', 'selected');
			}
		}
	}
	
	function edgeScrollToPanel(panel) {
		var pageHeader 				= $('.edge-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageTitle				= $('.edge-page-title');
		var pageTitleHeight			= pageTitle.outerHeight();
		
		var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;
		
		$('html, body').animate({
			scrollTop: panelTopPosition
		}, 1000);
		
		return false;
	}
	
	function totop_button(a) {
		"use strict";
		
		var b = $("#back_to_top");
		b.removeClass("off on");
		if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
	}
	
	function backButtonShowHide(){
		"use strict";
		
		$(window).scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
		});
	}
	
	function backToTop(){
		"use strict";
		
		$(document).on('click','#back_to_top',function(){
			$('html, body').animate({
				scrollTop: $('html').offset().top}, 1000);
			return false;
		});
	}
	
	function edgeChangedInput () {
		$('.edge-tabs-content form.edge_ajax_form:not(.edge-import-page-holder):not(.edge-backup-options-page-holder)').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
			$('.edge-input-change').addClass('yes');
		});
		
		$('.edge-tabs-content form.edge_ajax_form:not(.edge-import-page-holder):not(.edge-backup-options-page-holder) .field.switch label:not(.selected)').on('click', function() {
			$('.edge-input-change').addClass('yes');
		});
		
		$('.edge-tabs-content form.edge_ajax_form:not(.edge-import-page-holder):not(.edge-backup-options-page-holder) #anchornav input').on('click', function() {
			if ($('.edge-input-change.yes').length) {
				$('.edge-input-change.yes').removeClass('yes');
			}
			$('.edge-changes-saved').addClass('yes');
			setTimeout(function(){$('.edge-changes-saved').removeClass('yes');}, 3000);
		});
		
		$(window).on('beforeunload', function () {
			if ($('.edge-input-change.yes').length) {
				return 'You haven\'t saved your changes.';
			}
		});
	}
	
	function edgeCheckVisibilityOfAnchorButtons () {
		
		$('.edge-page-form > div:hidden').each( function() {
			var $panelID =  $(this).attr('id');
			$('#anchornav a').each ( function() {
				if ($(this).attr('href') == '#'+$panelID) {
					$(this).parent().hide();//hide <li>s
				}
			});
		})
	}
	
	function edgeCheckVisibilityOfAnchorOptions() {
		$('.edge-page-form > div:hidden').each( function() {
			var $panelID =  $(this).attr('id');
			$('#edge-select-anchor option').each ( function() {
				if ($(this).data('anchor') == '#'+$panelID) {
					$(this).hide();//hide <li>s
				}
			});
		})
	}
	
	function edgeGetArrayOfHiddenElements(changedElement) {
		var hidden_elements_string = changedElement.data('hide');
		hidden_elements_array = [];
		if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
			var hidden_elements_array = hidden_elements_string.split(',');
		} else {
			var hidden_elements_array = new Array(hidden_elements_string);
		}
		
		return hidden_elements_array;
	}
	
	function edgeGetArrayOfShownElements(changedElement) {
		//check for links to show
		var shown_elements_string = changedElement.data('show');
		shown_elements_array = [];
		if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
			var shown_elements_array = shown_elements_string.split(',');
		} else {
			var shown_elements_array = new Array(shown_elements_string);
		}
		
		return shown_elements_array;
	}
	
	function edgeGetArrayOfHiddenElementsSelectBox(changedElement,changedElementValue) {
		var hidden_elements_string = changedElement.data('hide-'+changedElementValue);
		hidden_elements_array = [];
		if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
			var hidden_elements_array = hidden_elements_string.split(',');
		} else {
			var hidden_elements_array = new Array(hidden_elements_string);
		}
		
		return hidden_elements_array;
	}
	
	function edgeGetArrayOfShownElementsSelectBox(changedElement,changedElementValue) {
		//check for links to show
		var shown_elements_string = changedElement.data('show-'+changedElementValue);
		shown_elements_array = [];
		if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
			var shown_elements_array = shown_elements_string.split(',');
		} else {
			var shown_elements_array = new Array(shown_elements_string);
		}
		
		return shown_elements_array;
	}
	
	function edgeCheckAnchorsOnDependencyChange(){
		$(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
			var hidden_elements_array = edgeGetArrayOfHiddenElements($(this));
			var shown_elements_array  = edgeGetArrayOfShownElements($(this));
			
			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#anchornav a').each ( function() {
					
					if ($(this).attr('href') == value) {
						$(this).parent().hide();//hide <li>s
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#anchornav a').each ( function() {
					if ($(this).attr('href') == value) {
						$(this).parent().show();//show <li>s
					}
				});
			});
		});
		
		$(document).on('change','.edge-form-element.dependence',function(){
			hidden_elements_array = edgeGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
			shown_elements_array  = edgeGetArrayOfShownElementsSelectBox($(this),$(this).val());
			
			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#anchornav a').each ( function() {
					
					if ($(this).attr('href') == value) {
						$(this).parent().hide();//hide <li>s
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#anchornav a').each ( function() {
					if ($(this).attr('href') == value) {
						$(this).parent().show();//show <li>s
					}
				});
			});
		});
	}
	
	function edgeCheckOptionAnchorsOnDependencyChange() {
		$(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
			var hidden_elements_array = edgeGetArrayOfHiddenElements($(this));
			var shown_elements_array  = edgeGetArrayOfShownElements($(this));
			
			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#edge-select-anchor option').each ( function() {
					
					if ($(this).data('anchor') == value) {
						$(this).hide();//hide option
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#edge-select-anchor option').each ( function() {
					if ($(this).data('anchor') == value) {
						$(this).show();//show option
					}
				});
			});
			
			$('#edge-select-anchor').selectpicker('refresh');
		});
		
		$(document).on('change','.edge-form-element.dependence',function(){
			hidden_elements_array = edgeGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
			shown_elements_array  = edgeGetArrayOfShownElementsSelectBox($(this),$(this).val());
			
			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#edge-select-anchor option').each ( function() {
					
					if ($(this).data('anchor') == value) {
						$(this).hide();//hide option
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#edge-select-anchor option').each ( function() {
					if ($(this).data('anchor') == value) {
						$(this).show();//show option
					}
				});
			});
			
			$('#edge-select-anchor').selectpicker('refresh');
		});
	}
	
	function edgeInitSelectChange() {
		var selectBox = $('select.dependence');
		selectBox.each(function() {
			initialHide($(this), this);
		});
		selectBox.on('change', function (e) {
			initialHide($(this), this);
		});
		
		function initialHide(selectField, selectObject) {
			var valueSelected = selectObject.value.replace(/ /g, '');
			$(selectField.data('hide-'+valueSelected)).fadeOut();
			$(selectField.data('show-'+valueSelected)).fadeIn();
		}
		
		var switchers = $('select.edge-switcher');
		switchers.each(function() {
			changeActions($(this), $(this).val(), true);
		});
		
		switchers.on('change', function (e) {
			var valueSelected = this.value.replace(/ /g, '');
			changeActions($(this), valueSelected, false);
		});
		
		function changeActions(selectField, valueSelected, initialCall) {
			var switchType = selectField.data('switch-type');
			var switchProperty = selectField.data('switch-property');
			var switchEnabled = selectField.data('switch-enabled');
			
			if (switchType === 'single_yesno') {
				var switchers = $('.switch-' + switchProperty);
				if (switchEnabled === valueSelected) {
					switchers.addClass('edge-switch-single-mode');
					switchers.attr('data-switch-selector', switchProperty);
				} else {
					switchers.removeClass('edge-switch-single-mode');
					switchers.removeAttr('data-switch-selector');
				}
				
				//On property change leave only one switcher enabled
				if(!initialCall) {
					var oneSwitcherEnabled = false;
					switchers.removeClass('switcher-auto-enabled');
					switchers.each(function () {
						var switcher = $(this);
						var enabled = $(this).find('.cb-enable');
						if (!oneSwitcherEnabled && enabled.hasClass('selected')) {
							oneSwitcherEnabled = true;
							$(this).addClass('switcher-auto-enabled');
						}
						if (!switcher.hasClass('switcher-auto-enabled')) {
							switcher.find('.cb-disable').addClass('selected');
							switcher.find('.cb-enable').removeClass('selected');
							switcher.find('.checkbox').attr('checked', false);
							switcher.find('.checkboxhidden_yesno').val("no");
						}
					});
				}
			}
		}
		
	}
	
	function edgeInitSwitch() {
		//Logic for setting element initial to be no
		var yesNoElements = $(".switch");
		yesNoElements.each(function () {
			var element = $(this);
			if (element.parents('.edge-repeater-field') && !element.find('input[type="hidden"]').val()) {
				element.find('.cb-enable').removeClass('selected');
				element.find('.cb-disable').addClass('selected');
			}
		});
		$(".cb-enable").on('click', function(){
			var parent = $(this).parents('.switch');
			//This condition is if only one element can be active, developed for repeater purposes
			//First disable all yes/no elements...
			if(parent.hasClass('edge-switch-single-mode')) {
				var selector = '.switch-'+ parent.data('switch-selector');
				var switchers = $(selector);
				switchers.each(function() {
					var switcher = $(this);
					switcher.find('.cb-disable').addClass('selected');
					switcher.find('.cb-enable').removeClass('selected');
					switcher.find('.checkbox').attr('checked', false);
					switcher.find('.checkboxhidden_yesno').val("no");
				});
				//Then enable the one that is clicked
				$('.cb-disable', parent).removeClass('selected');
				$(this).addClass('selected');
				$('.checkbox',parent).attr('checked', true);
				$('.checkboxhidden_yesno',parent).val("yes");
			} else {
				$('.cb-disable', parent).removeClass('selected');
				$(this).addClass('selected');
				$('.checkbox', parent).attr('checked', true);
				$('.checkboxhidden_yesno', parent).val("yes");
				$('.checkboxhidden_onoff', parent).val("on");
				$('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_follow");
				$('.checkboxhidden_zeroone', parent).val("1");
				$('.checkboxhidden_imagevideo', parent).val("image");
				$('.checkboxhidden_yesempty', parent).val("yes");
				$('.checkboxhidden_flagpost', parent).val("post");
				$('.checkboxhidden_flagpage', parent).val("page");
				$('.checkboxhidden_flagmedia', parent).val("attachment");
				$('.checkboxhidden_flagportfolio', parent).val("portfolio_page");
				$('.checkboxhidden_flagproduct', parent).val("product");
			}
		});
		$(".cb-disable").on('click', function(){
			var parent = $(this).parents('.switch');
			//If only one element can be active, than no value shouldn't be clickable
			if(!parent.hasClass('edge-switch-single-mode')) {
				$('.cb-enable', parent).removeClass('selected');
				$(this).addClass('selected');
				$('.checkbox', parent).attr('checked', false);
				$('.checkboxhidden_yesno', parent).val("no");
				$('.checkboxhidden_onoff', parent).val("off");
				$('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_no_follow");
				$('.checkboxhidden_zeroone', parent).val("0");
				$('.checkboxhidden_imagevideo', parent).val("video");
				$('.checkboxhidden_yesempty', parent).val("");
				$('.checkboxhidden_flagpost', parent).val("");
				$('.checkboxhidden_flagpage', parent).val("");
				$('.checkboxhidden_flagmedia', parent).val("");
				$('.checkboxhidden_flagportfolio', parent).val("");
				$('.checkboxhidden_flagproduct', parent).val("");
			}
		});
		$(".cb-enable.dependence").on('click', function(){
			$($(this).data('hide')).fadeOut();
			$($(this).data('show')).fadeIn();
		});
		$(".cb-disable.dependence").on('click', function(){
			$($(this).data('hide')).fadeOut();
			$($(this).data('show')).fadeIn();
		});
	}
	
	function edgeInitTooltips() {
		$('.edge-tooltip').tooltip();
	}
	
	function edgeInitColorpicker() {
		$('.edge-page .my-color-field').wpColorPicker({
			change:    function( event, ui ) {
				$('.edge-input-change').addClass('yes');
			}
		});
	}
	
	/**
	 * Function that initializes
	 */
	function edgeInitRangeSlider() {
		if($('.edge-slider-range').length) {
			
			$('.edge-slider-range').each(function() {
				var Link = $.noUiSlider.Link;
				
				var start       = 0;            //starting position of slider
				var min         = 0;            //minimal value
				var max         = 100;          //maximal value of slider
				var step        = 1;            //number of steps to snap to
				var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
				var prefix      = '';           //prefix to the serialized value that is written field
				var postfix     = '';           //postfix to the serialized value that is written to field
				var thousand    = '';           //separator for thousand
				var decimals    = 2;            //number of decimals
				var mark        = '.';          //decimal separator
				
				//is data-start attribute set for current instance?
				if($(this).data('start') != null && $(this).data('start') !== "" && $(this).data('start') != "0.00") {
					start = $(this).data('start');
					if (start == "1.00") start = 1;
					if(parseInt(start) == start){
						start = parseInt(start);
					}
				}
				
				//is data-min attribute set for current instance?
				if($(this).data('min') != null && $(this).data('min') !== "") {
					min = $(this).data('min');
				}
				
				//is data-max attribute set for current instance?
				if($(this).data('max') != null && $(this).data('max') !== "") {
					max = $(this).data('max');
				}
				
				//is data-step attribute set for current instance?
				if($(this).data('step') != null && $(this).data('step') !== "") {
					step = $(this).data('step');
				}
				
				//is data-orientation attribute set for current instance?
				if($(this).data('orientation') != null && $(this).data('orientation') !== "") {
					//define available orientations
					var availableOrientations = ['horizontal', 'vertical'];
					
					//is data-orientation value in array of available orientations?
					if(availableOrientations.indexOf($(this).data('orientation'))) {
						orientation = $(this).data('orientation');
					}
				}
				
				//is data-prefix attribute set for current instance?
				if($(this).data('prefix') != null && $(this).data('prefix') !== "") {
					prefix = $(this).data('prefix');
				}
				
				//is data-postfix attribute set for current instance?
				if($(this).data('postfix') != null && $(this).data('postfix') !== "") {
					postfix = $(this).data('postfix');
				}
				
				//is data-thousand attribute set for current instance?
				if($(this).data('thousand') != null && $(this).data('thousand') !== "") {
					thousand = $(this).data('thousand');
				}
				
				//is data-decimals attribute set for current instance?
				if($(this).data('decimals') != null && $(this).data('decimals') !== "") {
					decimals = $(this).data('decimals');
				}
				
				//is data-mark attribute set for current instance?
				if($(this).data('mark') != null && $(this).data('mark') !== "") {
					mark = $(this).data('mark');
				}
				
				$(this).noUiSlider({
					start: start,
					step: step,
					orientation: orientation,
					range: {
						'min': min,
						'max': max
					},
					serialization: {
						lower: [
							new Link({
								target: $(this).prev('.edge-slider-range-value')
							})
						],
						format: {
							// Set formatting
							thousand: thousand,
							postfix: postfix,
							prefix: prefix,
							decimals: decimals,
							mark: mark
						}
					}
				}).on({
					change: function(){
						$('.edge-input-change').addClass('yes');
					}
				});
			});
		}
	}
	
	function edgeInitMediaUploader() {
		if($('.edge-media-uploader').length) {
			$('.edge-media-uploader').each(function() {
				var fileFrame;
				var uploadUrl;
				var uploadHeight;
				var uploadWidth;
				var uploadImageHolder;
				var attachment;
				var removeButton;
				
				//set variables values
				uploadUrl           = $(this).find('.edge-media-upload-url');
				uploadHeight        = $(this).find('.edge-media-upload-height');
				uploadWidth        = $(this).find('.edge-media-upload-width');
				uploadImageHolder   = $(this).find('.edge-media-image-holder');
				removeButton        = $(this).find('.edge-media-remove-btn');
				
				if (uploadImageHolder.find('img').attr('src') != "") {
					removeButton.show();
					edgeInitMediaRemoveBtn(removeButton);
				}
				
				$(this).on('click', '.edge-media-upload-btn', function() {
					//if the media frame already exists, reopen it.
					if (fileFrame) {
						fileFrame.open();
						return;
					}
					
					//create the media frame
					fileFrame = wp.media.frames.fileFrame = wp.media({
						title: $(this).data('frame-title'),
						button: {
							text: $(this).data('frame-button-text')
						},
						multiple: false
					});
					
					//when an image is selected, run a callback
					fileFrame.on( 'select', function() {
						attachment = fileFrame.state().get('selection').first().toJSON();
						removeButton.show();
						edgeInitMediaRemoveBtn(removeButton);
						//write to url field and img tag
						if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
							uploadUrl.val(attachment.url);
							if (attachment.sizes.thumbnail)
								uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
							else
								uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						} else if (attachment.hasOwnProperty('url')) {
							uploadUrl.val(attachment.url);
							uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						}
						
						//write to hidden meta fields
						if(attachment.hasOwnProperty('height')) {
							uploadHeight.val(attachment.height);
						}
						
						if(attachment.hasOwnProperty('width')) {
							uploadWidth.val(attachment.width);
						}
						$('.edge-input-change').addClass('yes');
					});
					
					//open media frame
					fileFrame.open();
				});
			});
		}
		
		function edgeInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.edge-media-image-holder').hide();
				btn.siblings('.edge-media-image-holder').find('img').attr('src', '');
				
				//reset meta fields
				btn.siblings('.edge-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});
				
				btn.hide();
			});
		}
	}
	
	function edgeInitGalleryUploader() {
		
		var $edge_upload_button = jQuery('.edge-gallery-upload-btn');
		
		var $edge_clear_button = jQuery('.edge-gallery-clear-btn');
		
		wp.media.customlibEditGallery1 = {
			
			frame: function() {
				
				if ( this._frame )
					return this._frame;
				
				var selection = this.select();
				
				this._frame = wp.media({
					id: 'edge-portfolio-image-gallery',
					frame: 'post',
					state: 'gallery-edit',
					title: wp.media.view.l10n.editGalleryTitle,
					editing: true,
					multiple: true,
					selection: selection
				});
				
				this._frame.on('update', function() {
					
					var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
					var library = controller.get('library');
					// Need to get all the attachment ids for gallery
					var ids = library.pluck('id');
					
					$input_gallery_items.val(ids);

					var data = {
						action: 'adorn_edge_gallery_upload_get_images',
						ids: ids,
						post_name: $input_gallery_items.attr('name'),
						gallery_upload_get_images: $('#edgtf_gallery_upload_get_images_' + $input_gallery_items.attr('name')).val()
					};
					
					jQuery.ajax({
						type: "post",
						url: ajaxurl,
						data: data,
						success: function(data) {
							
							$thumbs_wrap.empty().html(data);
							
						}
					});
				});
				
				return this._frame;
			},
			
			init: function() {
				$edge_upload_button.on('click', function(event) {
					$thumbs_wrap = $(this).parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();
					
					event.preventDefault();
					wp.media.customlibEditGallery1.frame().open();
				});
				
				$edge_clear_button.on('click', function(event) {
					$thumbs_wrap = $edge_upload_button.parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();
					
					event.preventDefault();
					$thumbs_wrap.empty();
					$input_gallery_items.val("");
				});
			},
			
			// Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
			// in wp-includes/js/media-editor.js.source.html
			select: function() {
				
				var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
					defaultPostId = wp.media.gallery.defaults.id,
					attachments, selection;
				
				// Bail if we didn't match the shortcode or all of the content.
				if (!shortcode)
					return;
				
				// Ignore the rest of the match object.
				shortcode = shortcode.shortcode;
				
				if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
					shortcode.set('id', defaultPostId);
				
				attachments = wp.media.gallery.attachments(shortcode);
				selection = new wp.media.model.Selection(attachments.models, {
					props: attachments.props.toJSON(),
					multiple: true
				});
				
				selection.gallery = attachments.gallery;
				
				// Fetch the query's attachments, and then break ties from the
				// query to allow for sorting.
				selection.more().done(function() {
					// Break ties with the query.
					selection.props.set({
						query: false
					});
					selection.unmirror();
					selection.props.unset('orderby');
				});
				
				return selection;
			}
		};
		$(wp.media.customlibEditGallery1.init);
	}
	
	function edgeInitPortfolioItemAcc() {
		//remove portfolio item
		$(document).on('click', '.remove-portfolio-item', function(event) {
			event.preventDefault();
			var $toggleHolder = $(this).parent().parent().parent();
			$toggleHolder.fadeOut(300,function() {
				$(this).remove();
				
				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edge-portfolio-additional-item').each(function(i){
					$(this).attr('rel',i+1);
					$(this).find('.number').text($(this).attr('rel'));
					edgeSetIdOnRemoveItem($(this),i+1);
				});
				//hide expand all button if all items are removed
				noPortfolioItemShown();
			});
			return false;
		});
		
		//hide expand all button if there is no items
		noPortfolioItemShown();
		function noPortfolioItemShown()  {
			if($('.edge-portfolio-additional-item').length === 0){
				$('.edge-toggle-all-item').hide();
			}
		}
		
		//expand all additional sidebar items on click on 'expand all' button
		$(document).on('click', '.edge-toggle-all-item', function(event) {
			event.preventDefault();
			$('.edge-portfolio-additional-item').each(function(i){
				
				var $toggleContent = $(this).find('.edge-portfolio-toggle-content');
				var $this = $(this).find('.toggle-portfolio-item');
				if ($toggleContent.is(':visible')) {
				}
				else {
					$toggleContent.slideToggle();
					$this.html('<i class="fa fa-caret-down"></i>')
				}
			});
			return false;
		});
		//toggle for portfolio additional sidebar items
		$(document).on('click', '.edge-portfolio-additional-item .edge-portfolio-toggle-holder', function(event) {
			event.preventDefault();
			
			var $this = $(this);
			var $caret_holder = $this.find('.toggle-portfolio-item');
			$caret_holder.html('<i class="fa fa-caret-up"></i>');
			var $toggleContent = $this.next();
			$toggleContent.slideToggle(function() {
				if ($toggleContent.is(':visible')) {
					$caret_holder.html('<i class="fa fa-caret-up"></i>')
				}
				else {
					$caret_holder.html('<i class="fa fa-caret-down"></i>')
				}
				//hide expand all button function in case of all boxes revealed
				checkExpandAllBtn();
			});
			return false;
		});
		//hide expand all button when it's clicked
		$(document).on('click','.edge-toggle-all-item', function(event) {
			event.preventDefault();
			$(this).hide();
		})
		
		function checkExpandAllBtn() {
			if($('.edge-portfolio-additional-item .edge-portfolio-toggle-content:hidden').length === 0){
				$('.edge-toggle-all-item').hide();
			}else{
				$('.edge-toggle-all-item').show();
			}
		}
	}
	
	function edgeInitPortfolioItemsBox() {
		var edge_portfolio_additional_item = $('.edge-portfolio-additional-item-holder').clone().html();
		$portfolio_item = '<div class="edge-portfolio-additional-item" rel="">'+ edge_portfolio_additional_item +'</div>';
		
		$('.edge-portfolio-add a.edge-add-item').on('click', function (event) {
			event.preventDefault();
			$(this).parent().before($($portfolio_item).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edge-portfolio-additional-item').length;
			$(this).parent().siblings('.edge-portfolio-additional-item:last').attr('rel',portfolio_num);
			edgeSetIdOnAddItem($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});
	}
	
	function edgeSetIdOnAddItem(addButton,portfolio_num){
		addButton.siblings('.edge-portfolio-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+portfolio_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}
	
	function edgeSetIdOnRemoveItem(portfolio,portfolio_num){
		if(portfolio_num == undefined){
			var portfolio_num = portfolio.attr('rel');
		}else{
			var portfolio_num = portfolio_num;
		}
		
		portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+portfolio_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}
	
	function edgeInitPortfolioMediaAcc() {
		//remove portfolio media
		$(document).on('click', '.remove-portfolio-media', function(event) {
			event.preventDefault();
			var $toggleHolder = $(this).parent().parent().parent();
			$toggleHolder.fadeOut(300,function() {
				$(this).remove();
				
				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edge-portfolio-media').each(function(i){
					$(this).attr('rel',i+1);
					$(this).find('.number').text($(this).attr('rel'));
					edgeSetIdOnRemoveMedia($(this),i+1);
				});
				//hide expand all button if all medias are removed
				noPortfolioMedia()
			});  return false;
		});
		
		//hide 'expand all' button if there is no media
		noPortfolioMedia();
		function noPortfolioMedia() {
			if($('.edge-portfolio-media').length === 0){
				$('.edge-toggle-all-media').hide();
			}
		}
		
		//expand all portfolio medias (video and images) onClick on 'expand all' button
		$(document).on('click','.edge-toggle-all-media', function(event) {
			event.preventDefault();
			$('.edge-portfolio-media').each(function(i){
				
				var $toggleContent = $(this).find('.edge-portfolio-toggle-content');
				var $this = $(this).find('.toggle-portfolio-media');
				if ($toggleContent.is(':visible')) {
				}
				else {
					$toggleContent.slideToggle();
					$this.html('<i class="fa fa-caret-down"></i>')
				}
				
			});        return false;
		});
		//toggle for portfolio media (images or videos)
		$(document).on('click', '.edge-portfolio-media .edge-portfolio-toggle-holder', function(event) {
			event.preventDefault();
			var $this = $(this);
			var $caret_holder = $this.find('.toggle-portfolio-media');
			$caret_holder.html('<i class="fa fa-caret-up"></i>');
			var $toggleContent = $(this).next();
			$toggleContent.slideToggle(function() {
				if ($toggleContent.is(':visible')) {
					$caret_holder.html('<i class="fa fa-caret-up"></i>')
				}
				else {
					$caret_holder.html('<i class="fa fa-caret-down"></i>')
				}
				//hide expand all button function in case of all boxes revealed
				checkExpandAllMediaBtn();
			});
			return false;
		});
		//hide expand all button when it's clicked
		$(document).on('click','.edge-toggle-all-media', function(event) {
			event.preventDefault();
			$(this).hide();
		});
		function checkExpandAllMediaBtn() {
			if($('.edge-portfolio-media .edge-portfolio-toggle-content:hidden').length === 0){
				$('.edge-toggle-all-media').hide();
			}else{
				$('.edge-toggle-all-media').show();
			}
		}
	}
	
	function edgeInitPortfolioImagesVideosBox() {
		var edge_portfolio_images = $('.edge-hidden-portfolio-images').clone().html();
		$portfolio_image = '<div class="edge-portfolio-images edge-portfolio-media" rel="">'+ edge_portfolio_images +'</div>';
		var edge_portfolio_videos = $('.edge-hidden-portfolio-videos').clone().html();
		
		$portfolio_videos = '<div class="edge-portfolio-videos edge-portfolio-media" rel="">'+ edge_portfolio_videos +'</div>';
		$('a.edge-add-image').on('click', function (e) {
			e.preventDefault();
			$(this).parent().before($($portfolio_image).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edge-portfolio-media').length;
			$(this).parent().siblings('.edge-portfolio-media:last').attr('rel',portfolio_num);
			edgeInitMediaUploaderAdded($(this).parent());
			edgeSetIdOnAddMedia($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});
		
		$('a.edge-add-video').on('click', function (e) {
			e.preventDefault();
			$(this).parent().before($($portfolio_videos).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edge-portfolio-media').length;
			$(this).parent().siblings('.edge-portfolio-media:last').attr('rel',portfolio_num);
			edgeInitMediaUploaderAdded($(this).parent());
			edgeSetIdOnAddMedia($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});
		
		$(document).on('click', '.edge-remove-last-row-media', function(event) {
			event.preventDefault();
			$(this).parent().prev().fadeOut(300,function() {
				$(this).remove();
				
				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edge-portfolio-media').each(function(i){
					$(this).attr('rel',i+1);
					edgeSetIdOnRemoveMedia($(this),i+1);
				});
			});
			
		});
		edgeShowHidePorfolioImageVideoType();
		$(document).on('change', 'select.edge-portfoliovideotype', function(e) {
			edgeShowHidePorfolioImageVideoType();
		});
	}
	
	function edgeSetIdOnAddMedia(addButton,portfolio_num){
		addButton.siblings('.edge-portfolio-media:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+portfolio_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
			
		});
		
		edgeShowHidePorfolioImageVideoType();
	}
	
	function edgeSetIdOnRemoveMedia(portfolio,portfolio_num){
		
		if(portfolio_num == undefined){
			var portfolio_num = portfolio.attr('rel');
		}else{
			var portfolio_num = portfolio_num;
		}
		
		portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+portfolio_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}
	
	function edgeShowHidePorfolioImageVideoType(){
		
		$('.edge-portfoliovideotype').each(function(i){
			var $selected = $(this).val();
			
			if($selected == "self"){
				$(this).parent().parent().parent().find('.edge-video-id-holder').hide();
				$(this).parent().parent().parent().parent().find('.edge-media-uploader').show();
				$(this).parent().parent().parent().find('.edge-video-self-hosted-path-holder').show();
			}else{
				$(this).parent().parent().parent().find('.edge-video-id-holder').show();
				$(this).parent().parent().parent().parent().find('.edge-media-uploader').hide();
				$(this).parent().parent().parent().find('.edge-video-self-hosted-path-holder').hide();
			}
		});
	}
	
	function edgeInitMediaUploaderAdded(addButton) {
		
		addButton.siblings('.edge-portfolio-media:last, .edge-slide-element-additional-item:last').find('.edge-media-uploader').each(function(){
			var fileFrame;
			var uploadUrl;
			var uploadHeight;
			var uploadWidth;
			var uploadImageHolder;
			var attachment;
			var removeButton;
			
			//set variables values
			uploadUrl           = $(this).find('.edge-media-upload-url');
			uploadHeight        = $(this).find('.edge-media-upload-height');
			uploadWidth        = $(this).find('.edge-media-upload-width');
			uploadImageHolder   = $(this).find('.edge-media-image-holder');
			removeButton        = $(this).find('.edge-media-remove-btn');
			
			if (uploadImageHolder.find('img').attr('src') != "") {
				removeButton.show();
				edgeInitMediaRemoveBtn(removeButton);
			}
			
			$(this).on('click', '.edge-media-upload-btn', function() {
				//if the media frame already exists, reopen it.
				if (fileFrame) {
					fileFrame.open();
					return;
				}
				
				//create the media frame
				fileFrame = wp.media.frames.fileFrame = wp.media({
					title: $(this).data('frame-title'),
					button: {
						text: $(this).data('frame-button-text')
					},
					multiple: false
				});
				
				//when an image is selected, run a callback
				fileFrame.on( 'select', function() {
					attachment = fileFrame.state().get('selection').first().toJSON();
					removeButton.show();
					edgeInitMediaRemoveBtn(removeButton);
					//write to url field and img tag
					if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
						uploadUrl.val(attachment.url);
						if (attachment.sizes.thumbnail)
							uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
						else
							uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					} else if (attachment.hasOwnProperty('url')) {
						uploadUrl.val(attachment.url);
						uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					}
					
					//write to hidden meta fields
					if(attachment.hasOwnProperty('height')) {
						uploadHeight.val(attachment.height);
					}
					
					if(attachment.hasOwnProperty('width')) {
						uploadWidth.val(attachment.width);
					}
					$('.edge-input-change').addClass('yes');
				});
				
				//open media frame
				fileFrame.open();
			});
		});
		
		function edgeInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.edge-media-image-holder').hide();
				btn.siblings('.edge-media-image-holder').find('img').attr('src', '');
				
				//reset meta fields
				btn.siblings('.edge-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});
				
				btn.hide();
			});
		}
	}
	
	/**
	 Slide elements script - start
	 */
	function edgeInitSlideElementItemAcc() {
		//remove slide-element item
		$(document).on('click', '.remove-slide-element-item', function(event) {
			event.preventDefault();
			var $toggleHolder = $(this).parent().parent().parent();
			$toggleHolder.fadeOut(300,function() {
				$(this).remove();
				
				//after removing slide-element image, set new rel numbers and set new ids/names
				$('.edge-slide-element-additional-item').each(function(i){
					$(this).attr('rel',i+1);
					$(this).find('.number').text($(this).attr('rel'));
					edgeSetIdOnRemoveElement($(this),i+1);
				});
				//hide expand all button if all items are removed
				noSlideElementItemShown();
			});
			return false;
		});
		
		//hide expand all button if there is no items
		noSlideElementItemShown();
		function noSlideElementItemShown()  {
			if($('.edge-slide-element-additional-item').length === 0){
				$('.edge-toggle-all-item').hide();
			}
		}
		
		//expand all additional items on click on 'expand all' button
		$(document).on('click', '.edge-toggle-all-item', function(event) {
			event.preventDefault();
			$('.edge-slide-element-additional-item').each(function(i){
				
				var $toggleContent = $(this).find('.edge-slide-element-toggle-content');
				var $this = $(this).find('.toggle-slide-element-item');
				if ($toggleContent.is(':visible')) {
				}
				else {
					$toggleContent.slideToggle();
					$this.html('<i class="fa fa-caret-down"></i>')
				}
			});
			return false;
		});
		//toggle for slide-element item
		$(document).on('click', '.edge-slide-element-additional-item .edge-slide-element-toggle-holder', function(event) {
			event.preventDefault();
			
			var $this = $(this);
			var $caret_holder = $this.find('.toggle-slide-element-item');
			$caret_holder.html('<i class="fa fa-caret-up"></i>');
			var $toggleContent = $this.next();
			$toggleContent.slideToggle(function() {
				if ($toggleContent.is(':visible')) {
					$caret_holder.html('<i class="fa fa-caret-up"></i>')
				}
				else {
					$caret_holder.html('<i class="fa fa-caret-down"></i>')
				}
				//hide expand all button function in case of all boxes revealed
				checkExpandAllBtn();
			});
			return false;
		});
		//hide expand all button when it's clicked
		$(document).on('click','.edge-toggle-all-item', function(event) {
			event.preventDefault();
			$(this).hide();
		});
		
		//reveal only the fields for custom positioning of elements
		$(document).on('change', '#edge_edge_slide_holder_elements_alignment select', function(event) {
			var meta_box = $(this).parents('#edge-meta-box-edge_slides_elements');
			if ($(this).find('option:selected').attr('value') == 'custom') {
				meta_box.find('.edge-slide-element-custom-only').slideDown(300);
				meta_box.find('.edge-slide-element-all-but-custom').slideUp(300);
			}
			else {
				meta_box.find('.edge-slide-element-all-but-custom').slideDown(300);
				meta_box.find('.edge-slide-element-custom-only').slideUp(300);
			}
		});
		
		//reveal only the fields for certain type of the element
		$(document).on('change', '.edge-slide-element-type-selector', function(event) {
			var type_fields_holders = $(this).parents('.edge-slide-element-additional-item').find('.edge-slide-element-type-fields');
			type_fields_holders.not('.edge-setf-'+$(this).find('option:selected').attr('value')).slideUp(300);
			type_fields_holders.filter('.edge-setf-'+$(this).find('option:selected').attr('value')).slideDown(300);
		});
		
		// reveal advanced text options
		$(document).on('change', '.edge-slide-element-options-selector-text', function(event) {
			if ($(this).find('option:selected').attr('value') == 'advanced') {
				$(this).parents('.edge-slide-element-additional-item').find('.edge-slide-elements-advanced-text-options').slideDown(300);
				$(this).parents('.edge-slide-element-additional-item').find('.edge-slide-elements-simple-text-options').slideUp(300);
			}
			else {
				$(this).parents('.edge-slide-element-additional-item').find('.edge-slide-elements-advanced-text-options').slideUp(300);
				$(this).parents('.edge-slide-element-additional-item').find('.edge-slide-elements-simple-text-options').slideDown(300);
			}
		});
		
		// reveal responsive text options
		$(document).on('change', '.edge-slide-element-responsive-selector', function(event) {
			if ($(this).find('option:selected').attr('value') == 'yes') {
				$(this).parents('.edge-slide-element-type-fields').find('.edge-slide-element-scale-factors').slideDown(300);
			}
			else {
				$(this).parents('.edge-slide-element-type-fields').find('.edge-slide-element-scale-factors').slideUp(300);
			}
		});
		
		// reveal responsive element options
		$(document).on('change', '.edge-slide-element-responsiveness-selector', function(event) {
			if ($(this).find('option:selected').attr('value') == 'stages') {
				$(this).closest('.row').siblings('.edge-slide-responsive-scale-factors').slideDown(300);
			}
			else {
				$(this).closest('.row').siblings('.edge-slide-responsive-scale-factors').slideUp(300);
			}
		});
		
		//update the default screen width in elements
		$(document).on('change keyup', "input[name='edge_slide_elements_default_width']", function(event) {
			$(this).parents('#edge-meta-box-edge_slides_elements').find('.edge-slide-dynamic-def-width').html($(this).attr('value'));
		});
		
		// reveal proper icon picker
		$(document).on('change', '.edge-slide-element-button-icon-pack', function(event) {
			var icon_pack = $(this).find('option:selected').attr('value');
			if (icon_pack == 'no_icon') {
				$(this).parents('.edge-slide-element-additional-item').find('.edge-slide-element-button-icon-collection').slideUp(300);
			}
			else {
				$(this)
					.parents('.edge-slide-element-additional-item')
					.find('.edge-slide-element-button-icon-collection.'+icon_pack).slideDown(300)
					.siblings('.edge-slide-element-button-icon-collection').slideUp(300);
			}
		});
		
		function checkExpandAllBtn() {
			if($('.edge-slide-element-additional-item .edge-slide-element-toggle-content:hidden').length === 0){
				$('.edge-toggle-all-item').hide();
			}else{
				$('.edge-toggle-all-item').show();
			}
		}
	}
	
	function edgeInitSlideElementItemsBox() {
		
		$('.edge-slide-element-add a.edge-add-item').on('click', function (event) {
			var edge_slide_element = $('.edge-slide-element-additional-item-holder').clone().html();
			$slide_element = '<div class="edge-slide-element-additional-item" rel="">'+ edge_slide_element +'</div>';
			event.preventDefault();
			$(this).parent().before($($slide_element).hide().fadeIn(500));
			edgeInitMediaUploaderAdded($(this).parent());
			var elem_num = $(this).parent().siblings('.edge-slide-element-additional-item').length;
			var item = $(this).parent().siblings('.edge-slide-element-additional-item:last');
			item.attr('rel',elem_num);
			item.find('.wp-picker-container').each(function() {
				var picker = $(this);
				var input = picker.find('input[type="text"]');
				picker.before('<input type="text" id="'+ input.attr('id') +'" name="'+ input.attr('name') +'" value="" class="my-color-field"/>').remove();
			});
			item.find('.my-color-field').wpColorPicker();
			edgeSetIdOnAddElement($(this).parent(),elem_num);
			$(this).parent().prev().find('.number').text(elem_num);
		});
	}
	
	function edgeSetIdOnAddElement(addButton,elem_num){
		addButton.siblings('.edge-slide-element-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+elem_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}
	
	function edgeSetIdOnRemoveElement(element,elem_num){
		if(elem_num == undefined){
			var elem_num = element.attr('rel');
		}else{
			var elem_num = elem_num;
		}
		
		element.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+elem_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}
	
	/**
	 Slide elements script - end
	 */

	function edgeShowHidePostFormatsGutenberg() {
		var gutenbergEditor = $('.block-editor__container');

		if(gutenbergEditor.length) {
			var gPostFormatField = gutenbergEditor.find('.editor-post-format');

			gPostFormatField.find('select option').each(function () {
				$('#edge-meta-box-post_format_' + $(this).val() + '_meta').hide();
			});

			if (gPostFormatField.find('select option:selected')) {
				$('#edge-meta-box-post_format_' + gPostFormatField.find('select option:selected').val() + '_meta').fadeIn();
			}

			gPostFormatField.find('select').change(function(){
				edgeShowHidePostFormatsGutenberg();
			})
		}
	}

	function edgeInitAjaxForm() {
		$('#edge_top_save_button').on('click', function() {
			$('.edge_ajax_form').submit();
			if ($('.edge-input-change.yes').length) {
				$('.edge-input-change.yes').removeClass('yes');
			}
			$('.edge-changes-saved').addClass('yes');
			setTimeout(function(){$('.edge-changes-saved').removeClass('yes');}, 3000);
			return false;
		});
		$(document).delegate(".edge_ajax_form", "submit", function (a) {
			var b = $(this);
			var c = {
				action: "adorn_edge_save_options"
			};
			jQuery.ajax({
				url: ajaxurl,
				cache: !1,
				type: "POST",
				data: jQuery.param(c, !0) + "&" + b.serialize()
			}), a.preventDefault(), a.stopPropagation()
		})
	}
	
	function edgeInitDatePicker() {
		$( ".edge-input.datepicker" ).datepicker( { dateFormat: "MM dd, yy" });
	}
	
	function edgeInitSelectPicker() {
		$(".edge-selectpicker").selectpicker({
			style: 'btn-info',
			size: 10
		});
	}
	
	function edgeShowHidePostFormats(){
		$('input[name="post_format"]').each(function(){
			var id = $(this).attr('id');
			if(id !== '' && id !== undefined) {
				var	metaboxName = id.replace(/-/g, '_');
				$('#edge-meta-box-'+ metaboxName +'_meta').hide();
			}
		});
		
		var selectedId = $("input[name='post_format']:checked").attr("id");
		if(selectedId !== '' && selectedId !== undefined) {
			var selected = selectedId.replace(/-/g, '_');
			$('#edge-meta-box-' + selected + '_meta').fadeIn();
		}
		
		$("input[name='post_format']").change(function() {
			edgeShowHidePostFormats();
		});
	}
	
	function edgePageTemplatesMetaBoxDependency(){
		if($('#page_template').length) {
			var selected = $('#page_template').val();
			var template_name_parts = selected.split("-");
			
			if (template_name_parts[0] !== 'blog') {
				$('#edge-meta-box-blog-meta').hide();
			} else {
				$('#edge-meta-box-blog-meta').show();
			}
			$('select[name="page_template"]').change(function () {
				edgePageTemplatesMetaBoxDependency();
			});
		}
	}
	
	function edgeRepeater(){
		var wrapper = $('.edge-repeater-wrapper');
		
		if(wrapper.length) {
			wrapper.each(function() {
				var thisWrapper = $(this);
				initCoreRepeater(thisWrapper);
			});
		}
		
		function initCoreRepeater(wrapper) {
			initRemoveRow(wrapper);
			initEmptyRow(wrapper);
			
			//Init add new button
			var addNew = wrapper.find('> .edge-repeater-add .edge-clone'); // add new button
			addNew.on('click', function (e) {
				e.preventDefault();
				var thisAddNew = $(this);
				initCloneRow(wrapper, thisAddNew);
			});
		}
		
		function initRemoveRow(wrapper){
			var removeBtn = wrapper.find('.edge-clone-remove');
			removeBtn.on('click', function (e) {
				e.preventDefault();
				var thisRemoveBtn = $(this);
				var parentRow = thisRemoveBtn.closest('.edge-repeater-fields-row');
				var fieldsHolder = thisRemoveBtn.closest('.edge-repeater-fields-holder');
				var parentChildRepeater = !!fieldsHolder.hasClass('edge-enable-pc');
				var thisHolderRows;
				
				if(fieldsHolder.hasClass('edge-table-layout')) {
					thisHolderRows = fieldsHolder.find('tbody tr.edge-repeater-fields-row');
				} else {
					if(parentChildRepeater) {
						var name = thisRemoveBtn.data("name");
						thisHolderRows = fieldsHolder.find('> .edge-repeater-fields-row[data-name=' + name + ']');
					} else {
						thisHolderRows = fieldsHolder.find('> .edge-repeater-fields-row');
					}
				}
				
				if (thisHolderRows.length === 1) {
					parentRow.find(':input').val('').removeAttr('checked').removeAttr('selected');
					parentRow.hide();
				} else {
					parentRow.remove();
				}
			});
		}
		
		function initEmptyRow(wrapper) {
			var fieldsHolder = wrapper.find('> .edge-repeater-fields-holder');
			var thisHolderRows;
			if(fieldsHolder.hasClass('edge-table-layout')) {
				thisHolderRows = fieldsHolder.find('tbody tr.edge-repeater-fields-row');
			} else {
				thisHolderRows = fieldsHolder.find('> .edge-repeater-fields-row');
			}
			
			thisHolderRows.each(function() {
				var row = $(this);
				if (row.hasClass('edge-initially-hidden')) {
					row.hide();
				}
			});
		}
		
		function initCloneRow(wrapper, button) {
			var fieldsHolder = wrapper.find('> .edge-repeater-fields-holder');
			var parentChildRepeater = !!fieldsHolder.hasClass('edge-enable-pc');
			var rows;
			if(fieldsHolder.hasClass('edge-table-layout')) {
				rows = fieldsHolder.find('tbody tr.edge-repeater-fields-row');
			} else {
				if(parentChildRepeater) {
					var name = button.data("name");
					rows = fieldsHolder.find('> .edge-repeater-fields-row[data-name=' + name + ']');
				} else {
					rows = fieldsHolder.find('> .edge-repeater-fields-row');
				}
			}
			var append = true; // flag for showing or appending new row
			if (rows.length === 1 && rows.css('display') == 'none') {
				rows.show();
				append = false;
			}
			if (append) {
				var child = rows.eq(0);
				//FIND FIRST ELEMENT AND DESTROY INITIALIZED SCRIPTS
				child.find('.edge-repeater-field').each(function () {
					var thisField = $(this);
					thisField.find('select').each(function () {
						var thisInput = $(this);
						if(thisInput.hasClass('edge-select2')) {
							$('select.edge-select2').select2("destroy");
						}
					});
				});
				
				var rowIndex = button.data('count'); // number of rows for changing id stored as data of add new button
				var firstChild = rows.eq(0).clone(); // clone first row
				var colorPicker = false; // flag for initializing color picker - calling wpColorPicker
				var mediaUploader = false; // flag for initializing media uploader - calling mediaUploader
				var yesNoSwitcher = false; // flag for initializing yes no switcher - calling initSwitch
				var select2 = false; // flag for initializing select2 - calling select2
				var innerRepeater = false; // flag for initializing select2 - calling select2
				
				firstChild.find('.edge-repeater-field').each(function () {
						var thisField = $(this);
						var id = thisField.attr('id');
						if (typeof id !== 'undefined') {
							thisField.attr('id', id.slice(0, -1) + rowIndex); // change id - first row will have 0 as the last char
						}
						thisField.find(':input').each(function () {
							var thisInput = $(this);
							if (thisInput.hasClass('my-color-field')) { // if input type is color picker
								thisInput.parents('.wp-picker-container').html(thisInput); // overwrite added html with field html- wpColorPicker adds it on initialization
								colorPicker = true;
							}
							else if (thisInput.hasClass('edge-media-upload-url')) {// if input type is media uploader
								mediaUploader = true;
								var btn = thisInput.parent().siblings('.edge-media-remove-btn');
								edgeInitMediaRemoveBtn(btn); // get and init new remove btn
								btn.trigger('click'); // trigger click to reset values
							}
							else if(thisInput.hasClass('checkbox')) {
								yesNoSwitcher = true;
							}
							thisInput.val('').removeAttr('checked').removeAttr('selected'); //empty fields values
							if(thisInput.is(':radio')){
								thisInput.val(fieldsHolder.find(':radio').length);
							}
						});
						thisField.find('select').each(function () {
							var thisInput = $(this);
							if(thisInput.hasClass('edge-select2')) {
								select2 = true;
							}
						});
					}
				);
				rows.each(function () {
					if($(this).find('.edge-repeater-wrapper').length) {
						innerRepeater = true;
					}
				});
				button.data('count', rowIndex + 1); //increase number of rows
				firstChild.appendTo(fieldsHolder); // append html
				initCoreRepeater(firstChild.find('.edge-repeater-wrapper'));
				initRemoveRow(firstChild);
				if (colorPicker) { // reinit colorpickers
					$('.edge-page .my-color-field').wpColorPicker();
				}
				if (mediaUploader) {
					// deregister click on all media buttons (multiple frames will be opened otherwise)
					$('.edge-media-uploader').off('click', '.edge-media-upload-btn');
					edgeInitMediaUploader();
				}
				if (yesNoSwitcher) {
					edgeInitSwitch(); //init yes no switchers
				}
				if (select2) {
					edgeSelect2(); //init select2 script
				}
			}
		}
	}
	
	function edgeInitSortable() {
		var sortingHolder = $('.edge-sortable-holder');
		var enableParentChild = sortingHolder.hasClass('edge-enable-pc');
		sortingHolder.sortable({
			handle: '.edge-repeater-sort',
			cursor: 'move',
			placeholder: "placeholder",
			start: function(event, ui) {
				ui.placeholder.height(ui.item.height());
				if(enableParentChild) {
					if (ui.helper.hasClass('second-level')) {
						ui.placeholder.removeClass('placeholder');
						ui.placeholder.addClass('placeholder-sub');
					}
					else {
						ui.placeholder.removeClass('placeholder-sub');
						ui.placeholder.addClass('placeholder');
					}
				}
			},
			sort: function(event, ui) {
				if(enableParentChild) {
					var pos;
					if (ui.helper.hasClass('second-level')) {
						pos = ui.position.left + 50;
					}
					else {
						pos = ui.position.left;
					}
					if (pos >= 75 && !ui.helper.hasClass('second-level') && !ui.helper.hasClass('edge-sort-parent')) {
						ui.placeholder.removeClass('placeholder');
						ui.placeholder.addClass('placeholder-sub');
						ui.helper.addClass('second-level');
					}
					else if (pos < 30 && ui.helper.hasClass('second-level') && !ui.helper.hasClass('edge-sort-child')) {
						ui.placeholder.removeClass('placeholder-sub');
						ui.placeholder.addClass('placeholder');
						ui.helper.removeClass('second-level');
					}
				}
			}
		});
	}
	
	function edgeImportOptions(){
		
		if($('.edge-backup-options-page-holder').length) {
			var edgeImportBtn = $('#edge-import-theme-options-btn');
			edgeImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Options now?')) {
					edgeImportBtn.blur();
					edgeImportBtn.text('Please wait');
					var importValue = $('#import_theme_options').val();
					var importNonce = $('#edge_import_theme_options_secret').val();
					var data = {
						action: 'edge_core_import_theme_options',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								edgeImportBtn.text('Import');
								$('.edge-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	function edgeImportCustomSidebars(){
		
		if($('.edge-backup-options-page-holder').length) {
			var edgeImportBtn = $('#edge-import-custom-sidebars-btn');
			edgeImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Custom Sidebars now?')) {
					edgeImportBtn.blur();
					edgeImportBtn.text('Please wait');
					var importValue = $('#import_custom_sidebars').val();
					var importNonce = $('#edge_import_custom_sidebars_secret').val();
					var data = {
						action: 'edge_core_import_custom_sidebars',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								edgeImportBtn.text('Import');
								$('.edge-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	function edgeImportWidgets(){
		
		if($('.edge-backup-options-page-holder').length) {
			var edgeImportBtn = $('#edge-import-widgets-btn');
			edgeImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Widgets now?')) {
					edgeImportBtn.blur();
					edgeImportBtn.text('Please wait');
					var importValue = $('#import_widgets').val();
					var importNonce = $('#edge_import_widgets_secret').val();
					var data = {
						action: 'edge_core_import_widgets',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								edgeImportBtn.text('Import');
								$('.edge-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	
	function edgeInitImportContent(){
		var edgeImportHolder   = $('.edge-import-page-holder');
		
		if(edgeImportHolder.length) {
			var edgeImportBtn      = $('#edge-import-demo-data');
			var confirmMessage = edgeImportHolder.data('confirm-message');
			edgeImportBtn.on('click', function(e) {
				e.preventDefault();
				
				if (confirm(confirmMessage)) {
					$('.edge-import-load').css('display','block');
					var progressbar     = $('#progressbar');
					var import_opt      = $('#import_option').val();
					var import_expl     = $('#import_example').val();
					var p = 0;
					
					if(import_opt == 'content'){
						for( var i=1; i < 10; i++ ){
							var str;
							if (i < 10) str = 'adorn_content_0'+i+'.xml';
							else str = 'adorn_content_'+i+'.xml';
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'edge_core_data_import',
									xml: str,
									example: import_expl,
									import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
								},
								success: function(data, textStatus, XMLHttpRequest){
									p+= 10;
									$('.progress-value').html((p) + '%');
									progressbar.val(p);
									if (p === 90) {
										str = 'adorn_content_10.xml';
										jQuery.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'edge_core_data_import',
												xml: str,
												example: import_expl,
												import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
											},
											success: function(data, textStatus, XMLHttpRequest){
												p+= 10;
												$('.progress-value').html((p) + '%');
												progressbar.val(p);
												$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
											}
										});
									}
								}
							});
						}
					} else if(import_opt == 'widgets') {
						$.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'edge_core_widgets_import',
								example: import_expl
							},
							success: function(data, textStatus, XMLHttpRequest){
								$('.progress-value').html((100) + '%');
								progressbar.val(100);
							}
						});
						$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
					} else if(import_opt == 'options'){
						jQuery.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'edge_core_options_import',
								example: import_expl
							},
							success: function(data, textStatus, XMLHttpRequest){
								$('.progress-value').html((100) + '%');
								progressbar.val(100);
							}
						});
						$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
					} else if(import_opt == 'complete_content') {
						for(var i=1;i<10;i++){
							var str;
							if (i < 10) str = 'adorn_content_0'+i+'.xml';
							else str = 'adorn_content_'+i+'.xml';
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'edge_core_data_import',
									xml: str,
									example: import_expl,
									import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
								},
								success: function(data, textStatus, XMLHttpRequest){
									p+= 10;
									$('.progress-value').html((p) + '%');
									progressbar.val(p);
									if (p === 90) {
										str = 'adorn_content_10.xml';
										jQuery.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'edge_core_data_import',
												xml: str,
												example: import_expl,
												import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
											},
											success: function(data, textStatus, XMLHttpRequest){
												jQuery.ajax({
													type: 'POST',
													url: ajaxurl,
													data: {
														action: 'edge_core_other_import',
														example: import_expl
													},
													success: function(data, textStatus, XMLHttpRequest){
														//alert(data);
														$('.progress-value').html((100) + '%');
														progressbar.val(100);
														$('.progress-bar-message').html('<div class="alert alert-success">Import is completed.</div>');
													}
												});
											}
										});
									}
								}
							});
						}
					}
				}
				return false;
			});
		}
	}
	
})(jQuery);