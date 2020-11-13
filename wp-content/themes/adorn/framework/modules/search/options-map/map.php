<?php

if ( ! function_exists('adorn_edge_search_options_map') ) {

	function adorn_edge_search_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => esc_html__('Search', 'adorn'),
				'icon' => 'fa fa-search'
			)
		);

		$search_page_panel = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Search Page', 'adorn'),
				'name' => 'search_template',
				'page' => '_search_page'
			)
		);

		adorn_edge_add_admin_field(array(
			'name'        => 'search_page_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'adorn'),
            'description' 	=> esc_html__("Choose a sidebar layout for search page", 'adorn'),
            'default_value' => 'no-sidebar',
            'options'       => array(
                'no-sidebar'        => esc_html__('No Sidebar', 'adorn'),
                'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'adorn'),
                'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'adorn'),
                'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'adorn'),
                'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'adorn')
            ),
			'parent'      => $search_page_panel
		));

        $adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
        if(count($adorn_custom_sidebars) > 0) {
            adorn_edge_add_admin_field(array(
                'name' => 'search_custom_sidebar_area',
                'type' => 'selectblank',
                'label' => esc_html__('Sidebar to Display', 'adorn'),
                'description' => esc_html__('Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'adorn'),
                'parent' => $search_page_panel,
                'options' => $adorn_custom_sidebars
            ));
        }

		$search_panel = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Search', 'adorn'),
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_type',
				'default_value'	=> 'slide-from-header-bottom',
				'label' 		=> esc_html__('Select Search Type', 'adorn'),
				'description' 	=> esc_html__("Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'adorn'),
				'options' 		=> array(
					'fullscreen' => esc_html__('Fullscreen Search', 'adorn'),
					'slide-from-header-bottom' => esc_html__('Slide From Header Bottom', 'adorn'),
                    'covers-header' => esc_html__('Search Covers Header', 'adorn'),
                    'slide-from-window-top' => esc_html__('Slide from Window Top' , 'adorn')
				)
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_icon_pack',
				'default_value'	=> 'font_elegant',
				'label'			=> esc_html__('Search Icon Pack', 'adorn'),
				'description'	=> esc_html__('Choose icon pack for search icon', 'adorn'),
				'options'		=> adorn_edge_icon_collections()->getIconCollectionsExclude(array('linea_icons'))
			)
		);

        adorn_edge_add_admin_field(
            array(
                'parent'		=> $search_panel,
                'type'			=> 'yesno',
                'name'			=> 'search_in_grid',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Enable Grid Layout', 'adorn'),
                'description'	=> esc_html__('Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'adorn'),
            )
        );
		
		adorn_edge_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title'		=> esc_html__('Initial Search Icon in Header', 'adorn')
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Icon Size', 'adorn'),
				'description'	=> esc_html__('Set size for icon', 'adorn'),
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);
		
		$search_icon_color_group = adorn_edge_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> esc_html__('Icon Colors', 'adorn'),
				'description' => esc_html__('Define color style for icon', 'adorn'),
				'name'		=> 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = adorn_edge_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row'
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'	=> $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_color',
				'label'		=> esc_html__('Color', 'adorn')
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_hover_color',
				'label'		=> esc_html__('Hover Color', 'adorn')
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'enable_search_icon_text',
				'default_value'	=> 'no',
				'label'			=> esc_html__('Enable Search Icon Text', 'adorn'),
				'description'	=> esc_html__("Enable this option to show 'Search' text next to search icon in header", 'adorn'),
				'args'			=> array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = adorn_edge_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'enable_search_icon_text_container',
				'hidden_property'	=> 'enable_search_icon_text',
				'hidden_value'		=> 'no'
			)
		);
		
		$enable_search_icon_text_group = adorn_edge_add_admin_group(
			array(
				'parent'	=> $enable_search_icon_text_container,
				'title'		=> esc_html__('Search Icon Text', 'adorn'),
				'name'		=> 'enable_search_icon_text_group',
				'description'	=> esc_html__('Define style for search icon text', 'adorn')
			)
		);
		
		$enable_search_icon_text_row = adorn_edge_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row'
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color',
				'label'			=> esc_html__('Text Color', 'adorn')
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color_hover',
				'label'			=> esc_html__('Text Hover Color', 'adorn')
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_font_size',
				'label'			=> esc_html__('Font Size', 'adorn'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_line_height',
				'label'			=> esc_html__('Line Height', 'adorn'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = adorn_edge_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row2',
				'next'		=> true
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_text_transform',
				'label'			=> esc_html__('Text Transform', 'adorn'),
				'default_value'	=> '',
				'options'		=> adorn_edge_get_text_transform_array()
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_icon_text_google_fonts',
				'label'			=> esc_html__('Font Family', 'adorn'),
				'default_value'	=> '-1',
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_style',
				'label'			=> esc_html__('Font Style', 'adorn'),
				'default_value'	=> '',
				'options'		=> adorn_edge_get_font_style_array(),
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_weight',
				'label'			=> esc_html__('Font Weight', 'adorn'),
				'default_value'	=> '',
				'options'		=> adorn_edge_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = adorn_edge_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row3',
				'next'		=> true
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row3,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_letter_spacing',
				'label'			=> esc_html__('Letter Spacing', 'adorn'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
	}

	add_action('adorn_edge_options_map', 'adorn_edge_search_options_map', 15);
}