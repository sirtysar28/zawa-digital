<?php
/**
 * ZAWA Digital theme functions.
 *
 * @package Zawa_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ZAWA_VERSION', '1.3.2' );

/* ------------------------------------------------------------------ */
/*  Includes                                                           */
/* ------------------------------------------------------------------ */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/demo-setup.php';
require get_template_directory() . '/inc/quote-form.php';

/* ------------------------------------------------------------------ */
/*  Theme setup                                                        */
/* ------------------------------------------------------------------ */
function zawa_setup() {
	load_theme_textdomain( 'zawa-digital', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );

	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	// Custom logo via Customizer (fallback ke logo default ZAWA Digital).
	add_theme_support( 'custom-logo', array(
		'height'      => 168,
		'width'       => 406,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Image sizes.
	add_image_size( 'zawa-card', 800, 600, true );      // Kartu layanan / blog.
	add_image_size( 'zawa-wide', 1600, 900, true );     // Hero & banner.
	add_image_size( 'zawa-portrait', 800, 1000, true ); // Portfolio & team.

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'zawa-digital' ),
		'footer'  => esc_html__( 'Footer Menu', 'zawa-digital' ),
	) );
}
add_action( 'after_setup_theme', 'zawa_setup' );

function zawa_content_width() {
	$GLOBALS['content_width'] = 800;
}
add_action( 'after_setup_theme', 'zawa_content_width', 0 );

/* ------------------------------------------------------------------ */
/*  Assets                                                             */
/* ------------------------------------------------------------------ */
function zawa_assets() {
	// Fonts: Plus Jakarta Sans (heading) + Inter (body).
	wp_enqueue_style(
		'zawa-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'zawa-style', get_stylesheet_uri(), array(), ZAWA_VERSION );
	wp_enqueue_style( 'zawa-main', get_template_directory_uri() . '/assets/css/main.css', array( 'zawa-style' ), ZAWA_VERSION );

	wp_enqueue_script( 'zawa-main', get_template_directory_uri() . '/assets/js/main.js', array(), ZAWA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zawa_assets' );

/**
 * Preconnect untuk Google Fonts.
 */
function zawa_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'zawa_resource_hints', 10, 2 );

/* ------------------------------------------------------------------ */
/*  Favicon default (pakai logo ZAWA sampai Site Icon diisi)           */
/* ------------------------------------------------------------------ */
function zawa_default_site_icon( $url, $size, $blog_id ) {
	if ( empty( $url ) ) {
		$url = get_template_directory_uri() . '/assets/img/favicon.png';
	}
	return $url;
}
add_filter( 'get_site_icon_url', 'zawa_default_site_icon', 10, 3 );

/* ------------------------------------------------------------------ */
/*  Widget areas                                                       */
/* ------------------------------------------------------------------ */
function zawa_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'zawa-digital' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Tampil di samping artikel blog & arsip.', 'zawa-digital' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'zawa_widgets_init' );

/* ------------------------------------------------------------------ */
/*  Body classes                                                       */
/* ------------------------------------------------------------------ */
function zawa_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( zawa_is_elementor_page() ) {
		$classes[] = 'zawa-elementor-page';
	}
	if ( is_front_page() && ! zawa_is_elementor_page() ) {
		$classes[] = 'zawa-home-fallback';
	}

	// Sticky header on/off (Customizer → Header & Menu).
	if ( ! zawa_get_option( 'zawa_sticky_desktop' ) ) {
		$classes[] = 'zawa-header-static-desktop';
	}
	if ( ! zawa_get_option( 'zawa_sticky_mobile' ) ) {
		$classes[] = 'zawa-header-static-mobile';
	}

	return $classes;
}
add_filter( 'body_class', 'zawa_body_classes' );

/* ------------------------------------------------------------------ */
/*  Excerpts                                                           */
/* ------------------------------------------------------------------ */
function zawa_excerpt_length( $length ) {
	return is_admin() ? $length : 24;
}
add_filter( 'excerpt_length', 'zawa_excerpt_length' );

function zawa_excerpt_more( $more ) {
	return is_admin() ? $more : '&hellip;';
}
add_filter( 'excerpt_more', 'zawa_excerpt_more' );

/* ------------------------------------------------------------------ */
/*  Elementor compatibility                                            */
/* ------------------------------------------------------------------ */

/**
 * Daftarkan lokasi template Elementor (Header, Footer, Single, Archive)
 * agar bisa dioverride lewat Elementor Pro Theme Builder.
 */
function zawa_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_locations();
}
add_action( 'elementor/theme/register_locations', 'zawa_register_elementor_locations' );

/**
 * Apakah halaman ini dibangun dengan Elementor?
 */
function zawa_is_elementor_page( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return false;
	}
	return 'builder' === get_post_meta( $post_id, '_elementor_edit_mode', true ) || 'editor' === get_post_meta( $post_id, '_elementor_edit_mode', true );
}

/**
 * Pastikan konten Elementor tidak dibungkus container theme.
 */
function zawa_elementor_container_class( $classes ) {
	if ( zawa_is_elementor_page() ) {
		$classes .= ' zawa-container--full';
	}
	return $classes;
}
add_filter( 'zawa_container_class', 'zawa_elementor_container_class' );

/**
 * Sembunyikan judul halaman default ketika dibangun dengan Elementor
 * (Elementor punya widget Page Title sendiri).
 */
add_filter( 'zawa_show_page_title', function ( $show ) {
	return zawa_is_elementor_page() ? false : $show;
} );
