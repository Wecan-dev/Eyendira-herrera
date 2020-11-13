<?php

if ( ! function_exists('adorn_edge_like') ) {
	/**
	 * Returns AdornEdgeLike instance
	 *
	 * @return AdornEdgeLike
	 */
	function adorn_edge_like() {
		return AdornEdgeLike::get_instance();
	}
}

function adorn_edge_get_like() {

	echo wp_kses(adorn_edge_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	));
}

if ( ! function_exists('adorn_edge_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function adorn_edge_like_latest_posts() {
		return adorn_edge_like()->add_like();
	}
}

if ( ! function_exists('adorn_edge_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function adorn_edge_like_portfolio_list($portfolio_project_id) {
		return adorn_edge_like()->add_like_portfolio_list($portfolio_project_id);
	}
}

if ( ! function_exists('adorn_edge_like_portfolio_single') ) {
    /**
     * Add like to portfolio project
     *
     * @param $portfolio_project_id
     * @return string
     */
    function adorn_edge_like_portfolio_single() {
        return adorn_edge_like()->add_like_portfolio_single();
    }
}