<?php

/*** Child Theme Function  ***/
if ( ! function_exists( 'adorn_edge_child_theme_enqueue_scripts' ) ) {
	function adorn_edge_child_theme_enqueue_scripts()
	{
		$parent_style = 'adorn-edge-default-style';

		wp_enqueue_style('adorn-edge-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
	}

	add_action('wp_enqueue_scripts', 'adorn_edge_child_theme_enqueue_scripts');
}


//traducir

add_filter('gettext',  'translate_text');
add_filter('ngettext',  'translate_text');

function translate_text($translated) {
     $translated = str_ireplace('Home',  'Inicio',  $translated);
     $translated = str_ireplace('Type here',  'Escribe aqui',  $translated);
     $translated = str_ireplace('SEARCH RESULTS FOR',  'BUSCAR RESULTADOS PARA',  $translated);
     $translated = str_ireplace('SEARCH RESULTS',  'BUSCAR RESULTADOS',  $translated);
     $translated = str_ireplace('If you are not happy with the results below please do another search',  'Si no está satisfecho con los resultados a continuación, realice otra búsqueda
',  $translated);
     $translated = str_ireplace('No posts were found.',  'No se encontraron publicaciones.',  $translated);
     $translated = str_ireplace('SEARCH RESULTS',  'Buscar resultados',  $translated);
     $translated = str_ireplace('SEARCH HERE',  'Buscar',  $translated);
     $translated = str_ireplace('HELLO',  '¡HOLA!',  $translated);
     $translated = str_ireplace('Back to top',  'Volver arriba',  $translated);
     $translated = str_ireplace('Cart',  'Carrito',  $translated);
     $translated = str_ireplace('Checkout',  'Pagar',  $translated);
     $translated = str_ireplace('VIEW CARRITO',  'Ver carrito',  $translated);
     $translated = str_ireplace('Quantity',  'Cantidad',  $translated);
  

     return $translated;
}