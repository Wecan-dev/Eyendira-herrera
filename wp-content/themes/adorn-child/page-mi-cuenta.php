<!-- <h2>page mi cuenta</h2> -->
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
get_header(); ?>
<div class="container mi-cuenta-tecniplas">
	
	<?php echo do_shortcode('[woocommerce_my_account]'); ?>
	<?php if (is_user_logged_in()) { ?>
	<?php  } else { ?>
	 <div class="inicia-sesion">
		<p>¿Aún no tienes cuenta?</p>
        <a class="opcion-mi-cuenta" href="<?php echo bloginfo('url').'/index.php/registro';?>">
          Registrate
       </a>
	</div>
	<?php  }  ?>
</div>
<?php get_footer();?>