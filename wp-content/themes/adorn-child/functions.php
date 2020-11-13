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
     $translated = str_ireplace('Cart',  'CARRITO',  $translated);
	 $translated = str_ireplace('CART',  'CARRITO',  $translated);
	 $translated = str_ireplace('back to top',  'volver',  $translated);
	 $translated = str_ireplace('view',  'ver',  $translated);
	 $translated = str_ireplace('checkout',  'pagar',  $translated);
	 $translated = str_ireplace('SHOPPING CARRITO',  'carrito de compras',  $translated);
	 $translated = str_ireplace('Go Back Shopping',  'Volver a la tienda',  $translated);
	 $translated = str_ireplace('Quantity',  'Cantidad',  $translated);
	 $translated = str_ireplace('Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our política de privacidad.

',  'nuestras politicas',  $translated);
	 $translated = str_ireplace('My Account',  'Mi cuenta',  $translated);
	 $translated = str_ireplace('No products in the carrito',  'No hay productos en el carrito',  $translated);
	 $translated = str_ireplace('hello',  '¡Hola!',  $translated);
	 $translated = str_ireplace('search here',  'BUSCAR',  $translated);
	 $translated = str_ireplace('CLOSE',  'CERRAR',  $translated);
	 $translated = str_ireplace('ADDING TO CARRITO',  'AGREGANDO AL CARRITO',  $translated);
	 $translated = str_ireplace('filter',  'filtro',  $translated);
	 $translated = str_ireplace('sort by',  'ordenar por',  $translated);
	 $translated = str_ireplace('price range',  'Rango de precio',  $translated);
	 $translated = str_ireplace('shop',  'Tienda',  $translated);
	 $translated = str_ireplace('LEAVE A COMMENT',  'Dejanos un comentario',  $translated);
	 $translated = str_ireplace('WRITE A COMMENT',  'Escribe un comentario',  $translated);
	 $translated = str_ireplace('SUBMIT',  'ENVIAR',  $translated);
	 $translated = str_ireplace('REPLY',  'RESPONDER',  $translated);
	 $translated = str_ireplace('TYPE HERE',  'ESCRIBE AQUI',  $translated);
	     $translated = str_ireplace('Login',  'Ingresar',  $translated);
     $translated = str_ireplace('Register',  'Registar',  $translated);
     $translated = str_ireplace('Remember me',  'Recuerdame',  $translated);
     $translated = str_ireplace('Repeat password',  'Repetir contraseña',  $translated);
     $translated = str_ireplace('sign in',  'Registrarse',  $translated);
     $translated = str_ireplace('My account',  'Mi cuenta',  $translated);
     $translated = str_ireplace('Profile',  'Perfil',  $translated);
     $translated = str_ireplace('Edit Profile',  'Editar Perfil',  $translated);
     $translated = str_ireplace('Log out',  'Salir',  $translated);
     $translated = str_ireplace('Lost your password?',  '¿Olvido su contraseña?',  $translated);
     $translated = str_ireplace('User name',  'Usuario',  $translated);
     $translated = str_ireplace('Password',  'Contraseña',  $translated);
     $translated = str_ireplace('Type here',  'Escribe aqui',  $translated);
     $translated = str_ireplace('SEARCH RESULTS:',  'RESULTADOS DE LA BUSQUEDA:',  $translated);
     $translated = str_ireplace('Type here',  'Escribe aqui',  $translated);
     $translated = str_ireplace('If you are not happy with the results below please do another search',  'Pueba con otra busqueda',  $translated);
     $translated = str_ireplace('No posts were found.',  'No se han encontrado entradas',  $translated);






     return $translated;
}