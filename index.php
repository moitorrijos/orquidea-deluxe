<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ordquidea-deluxe
 */

get_header();
?>

<div class="esquina-arriba-izq"></div>
<div class="esquina-arriba-der"></div>
<div class="esquina-abajo-izq"></div>
<div class="esquina-abajo-der"></div>

<div class="orquidea-deluxe-hero">
	<h2>Te presentamos</h2>
	<img src="<?php echo get_template_directory_uri(); ?>/images/orquidea-deluxe-logo@2x.png" alt="Orquidea Deluxe">
	<h1>Una Experiencia de lujo en Arraiján</h1>
	<a href="https://ecogardensarraijan.com/wp-content/uploads/2021/08/brochure-orquidea-deluxe_compressed.pdf" class="cta-button">Descarga el Brochure</a>
</div>

<?php
get_footer();
