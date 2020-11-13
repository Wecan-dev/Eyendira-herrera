<?php

//top header bar
add_action('adorn_edge_before_page_header', 'adorn_edge_get_header_top');

//mobile header
add_action('adorn_edge_after_page_header', 'adorn_edge_get_mobile_header');