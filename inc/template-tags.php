<?php
/**
 * Template tags & helper functions.
 *
 * @package Zawa_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class attribute untuk container utama.
 */
function zawa_container_class( $class = '' ) {
	$classes = array( 'zawa-container' );
	$classes = apply_filters( 'zawa_container_class', implode( ' ', $classes ) );
	echo 'class="' . esc_attr( trim( $classes . ' ' . $class ) ) . '"';
}

/**
 * Tampilkan logo: custom logo jika ada, fallback ke logo default ZAWA.
 */
function zawa_site_logo( $size = 'medium' ) {
	if ( has_custom_logo() ) {
		$logo_id = get_theme_mod( 'custom_logo' );
		printf(
			'<a class="zawa-logo" href="%s" rel="home">%s</a>',
			esc_url( home_url( '/' ) ),
			wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'zawa-logo__img' ) )
		);
		return;
	}

	// Fallback: logo bawaan theme (Logo_Zawa_Digital.png).
	printf(
		'<a class="zawa-logo" href="%s" rel="home"><img class="zawa-logo__img" src="%s" alt="%s" width="203" height="84" /></a>',
		esc_url( home_url( '/' ) ),
		esc_url( get_template_directory_uri() . '/assets/img/logo.png' ),
		esc_attr( get_bloginfo( 'name', 'display' ) )
	);
}

/**
 * Ikon SVG inline sederhana (tanpa dependency icon font).
 */
function zawa_icon( $name, $size = 24 ) {
	$icons = array(
		'menu'     => '<path d="M3 6h18M3 12h18M3 18h18" stroke-linecap="round"/>',
		'close'    => '<path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"/>',
		'arrow'    => '<path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"/>',
		'whatsapp' => '<path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Z" /><path d="M8.5 7.5c.3-.8.7-.8 1.1-.8h.6c.2 0 .5 0 .7.5s.8 2 .9 2.1c0 .2.1.4 0 .6-.3.6-.7.8-.5 1.2.7 1.2 1.6 2 2.9 2.6.4.2.6.2.8-.1l.7-.9c.3-.3.5-.2.8-.1l2 1c.3.1.5.2.5.4 0 .5-.3 1.6-1.4 2-1 .4-2.3.2-4.2-.9-1.9-1.1-3.2-2.8-3.7-3.7-.6-1-1-2.1-.9-2.9 0-.6.2-1 .4-1.1Z" />',
		'check'    => '<path d="M4 12.5l5 5L20 6.5" stroke-linecap="round" stroke-linejoin="round"/>',
		'services' => '<rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/>',
		'globe'    => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.5 3.8 5.6 3.8 9S14.5 18.5 12 21c-2.5-2.5-3.8-5.6-3.8-9S9.5 5.5 12 3Z"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="3"/><path d="m4 7 8 6 8-6"/>',
		'pin'      => '<path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/>',
		'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a12 12 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/>',
		'spark'    => '<path d="M12 2v4m0 12v4M2 12h4m12 0h4M4.9 4.9l2.8 2.8m8.6 8.6 2.8 2.8m0-14.2-2.8 2.8m-8.6 8.6-2.8 2.8"/>',
		/* Ikon sosial media (footer / customizer) */
		'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/>',
		'facebook'  => '<path d="M13.4 21v-6.9h2.3l.4-2.8h-2.7V9.6c0-.8.3-1.4 1.5-1.4h1.3V5.7c-.6-.1-1.3-.2-2-.2-2.1 0-3.5 1.2-3.5 3.6v2.2H8.1v2.8h2.7V21h2.6Z"/>',
		'linkedin'  => '<path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3V9Zm7 0h3.8v1.7h.05c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.78 2.65 4.78 6.1V21h-4v-5.5c0-1.3-.02-3-1.83-3-1.83 0-2.1 1.43-2.1 2.9V21h-4V9Z"/>',
		'x'         => '<path d="M4.5 3h3.8l3.7 5.2L15.9 3h3.7l-5.7 8 5.9 10h-3.8l-4-6.8L7.4 21H3.7l6.1-8.5L4.5 3Z"/>',
		'tiktok'    => '<path d="M16.6 3h2.8v3.3c0 2 1.5 3.6 3.6 3.9v2.9c-1.3 0-2.6-.4-3.6-1v5.8a5.7 5.7 0 1 1-5.7-5.7c.3 0 .6 0 .9.1v3a2.8 2.8 0 1 0 2 2.6V3Z"/>',
		'youtube'   => '<path d="M21.6 7.2a2.6 2.6 0 0 0-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4A2.6 2.6 0 0 0 2.4 7.2 26 26 0 0 0 2 12c0 1.6.1 3.2.4 4.8a2.6 2.6 0 0 0 1.8 1.8c1.6.4 7.8.4 7.8.4s6.2 0 7.8-.4a2.6 2.6 0 0 0 1.8-1.8c.3-1.6.4-3.2.4-4.8 0-1.6-.1-3.2-.4-4.8ZM10 15.2V8.8l5.4 3.2L10 15.2Z"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$stroke_icons = array( 'menu', 'close', 'arrow', 'check', 'spark', 'instagram' );
	$fill         = in_array( $name, $stroke_icons, true ) ? 'none' : 'currentColor';
	$stroke       = in_array( $name, $stroke_icons, true ) ? 'currentColor' : 'none';
	$stroke_width = in_array( $name, $stroke_icons, true ) ? 2 : 0;

	return sprintf(
		'<svg class="zawa-icon zawa-icon--%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="%3$s" stroke="%4$s" stroke-width="%5$d" aria-hidden="true" focusable="false">%6$s</svg>',
		esc_attr( $name ),
		(int) $size,
		$fill,
		$stroke,
		$stroke_width,
		$icons[ $name ]
	);
}

/**
 * Daftar sosial media default footer (dipakai saat repeater belum pernah disimpan).
 * Termasuk migrasi otomatis dari opsi lama zawa_instagram / zawa_linkedin.
 */
function zawa_footer_socials() {
	// Sudah pernah disimpan via Customizer? Pakai apa adanya (termasuk array kosong
	// = user sengaja menghapus semua).
	$saved = get_theme_mod( 'zawa_socials', null );
	if ( null !== $saved && is_array( $saved ) ) {
		return $saved;
	}

	// Belum pernah disimpan → migrasi setting lama + WhatsApp bawaan.
	$socials = array();
	$ig = zawa_get_option( 'zawa_instagram' );
	$li = zawa_get_option( 'zawa_linkedin' );
	if ( $ig ) {
		$socials[] = array( 'icon' => 'instagram', 'name' => 'Instagram', 'url' => $ig );
	}
	if ( $li ) {
		$socials[] = array( 'icon' => 'linkedin', 'name' => 'LinkedIn', 'url' => $li );
	}
	$socials[] = array(
		'icon' => 'whatsapp',
		'name' => 'WhatsApp',
		'url'  => zawa_whatsapp_link( 'Halo ZAWA Digital!' ),
	);

	return $socials;
}

/**
 * tombol/link "Request Quote" — dipakai header, footer & floating button.
 */
function zawa_quote_url() {
	$url = get_theme_mod( 'zawa_quote_url' );
	if ( $url ) {
		return $url;
	}
	$page = get_page_by_path( 'request-quote' ) ? get_page_by_path( 'request-quote' ) : get_page_by_path( 'request-a-quote' );
	return $page ? get_permalink( $page ) : home_url( '/request-quote/' );
}

/**
 * Nomor WhatsApp dinormalisasi ke format internasional tanpa tanda non-digit.
 */
function zawa_whatsapp_link( $text = '' ) {
	$number = get_theme_mod( 'zawa_wa_number', '6281321873330' );
	$number = preg_replace( '/\D+/', '', $number );
	$link   = 'https://wa.me/' . $number;
	if ( $text ) {
		$link .= '?text=' . rawurlencode( $text );
	}
	return $link;
}

/**
 * Sidebar aktif?
 */
function zawa_has_sidebar() {
	return ( is_active_sidebar( 'sidebar-1' ) && ( is_home() || is_archive() || is_search() || ( is_singular( 'post' ) && ! zawa_is_elementor_page() ) ) );
}

/**
 * Format nomor WA 62813xxxx -> +62 813-xxxx-xxxx agar mudah dibaca.
 */
function zawa_format_phone( $number ) {
	$number = preg_replace( '/\D+/', '', $number );
	if ( 0 === strpos( $number, '62' ) && 10 <= strlen( $number ) ) {
		return '+62 ' . substr( $number, 2, 3 ) . '-' . substr( $number, 5, 4 ) . '-' . substr( $number, 9 );
	}
	return $number;
}

/**
 * Item menu CTA "Request Quote" — SATU-satunya tombol quote di header,
 * ditambahkan otomatis sebagai item terakhir menu primer
 * (desktop: ujung kanan menu • mobile: di dalam drawer).
 */
function zawa_menu_cta_li() {
	return sprintf(
		'<li class="zawa-menu-cta"><a href="%s">%s<span>%s</span></a></li>',
		esc_url( zawa_quote_url() ),
		zawa_icon( 'spark', 18 ),
		esc_html__( 'Request Quote', 'zawa-digital' )
	);
}

/**
 * Sisipkan CTA ke akhir menu primer (bila menu dibuat lewat WP Admin).
 */
function zawa_nav_menu_cta( $items, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$items .= zawa_menu_cta_li();
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'zawa_nav_menu_cta', 10, 2 );

/**
 * Fallback menu bila belum ada menu yang dibuat.
 */
function zawa_nav_fallback() {
	$items = array(
		__( 'Home', 'zawa-digital' )         => home_url( '/' ),
		__( 'Services', 'zawa-digital' )     => home_url( '/services/' ),
		__( 'Case Studies', 'zawa-digital' ) => home_url( '/case-studies/' ),
		__( 'Blog', 'zawa-digital' )         => home_url( '/blog/' ),
	);
	echo '<ul class="zawa-nav__menu">';
	foreach ( $items as $label => $url ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo zawa_menu_cta_li();
	echo '</ul>';
}

/**
 * Posted by / date untuk blog.
 */
function zawa_posted_on() {
	printf(
		'<div class="zawa-entry-meta">
			<time datetime="%1$s">%2$s</time>
			<span class="zawa-entry-meta__sep" aria-hidden="true"></span>
			<span>%3$s</span>
		</div>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_html( get_the_author() )
	);
}
