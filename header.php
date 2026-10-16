<?php
/**
 * The header for our theme.
 *
 * @package Zawa_Digital
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#zawa-content"><?php esc_html_e( 'Skip to content', 'zawa-digital' ); ?></a>

<?php
// Jika Elementor Pro Theme Builder meng-override lokasi "header", pakai itu.
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	get_template_part( 'template-parts/header/site-header' );
}
?>

<main id="zawa-content" class="zawa-site-main">
