<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}?>
<div class="container mi-cuenta-tecniplas">

    <div class="" id="customer_login">
        <div class="">
            <h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>
            <?php echo do_shortcode('[user_registration_form id="6812"]'); ?>
        </div>
    </div>
  <p class="inicia-sesion">
        ¿Ya tienes cuenta? <br>	
         <a class="opcion-mi-cuenta" href="<?php echo bloginfo('url') . '/index.php/mi-cuenta'; ?>">
          Inicia Sesión
       </a>
	</p>
</div>

<?php get_footer();