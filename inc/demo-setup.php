<?php
/**
 * Setup otomatis saat theme diaktifkan:
 * - Membuat halaman: Home, Services, Case Studies, Blog, Request Quote
 * - Mengatur homepage statis & posts page
 * - Membuat menu utama: Home – Services – Case Studies – Blog
 *
 * @package Zawa_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function zawa_after_activation() {
	// Jangan jalankan dua kali.
	if ( get_option( 'zawa_demo_setup_done' ) ) {
		return;
	}

	/* ---- Halaman ---- */
	$pages = array(
		'home'          => array(
			'title'   => __( 'Home', 'zawa-digital' ),
			'slug'    => 'home',
			'content' => '',
		),
		'services'      => array(
			'title'   => __( 'Services', 'zawa-digital' ),
			'slug'    => 'services',
			'content' => zawa_default_services_content(),
		),
		'case-studies'  => array(
			'title'   => __( 'Case Studies', 'zawa-digital' ),
			'slug'    => 'case-studies',
			'content' => zawa_default_cases_content(),
		),
		'request-quote' => array(
			'title'   => __( 'Request a Quote', 'zawa-digital' ),
			'slug'    => 'request-quote',
			'template' => 'page-templates/request-quote.php',
		),
		'blog'          => array(
			'title'   => __( 'Blog', 'zawa-digital' ),
			'slug'    => 'blog',
			'content' => '',
		),
	);

	$ids = array();
	foreach ( $pages as $key => $page ) {
		$existing = get_page_by_path( $page['slug'] );
		if ( $existing ) {
			$ids[ $key ] = $existing->ID;
			continue;
		}
		$id = wp_insert_post( array(
			'post_title'   => $page['title'],
			'post_name'    => $page['slug'],
			'post_content' => isset( $page['content'] ) ? $page['content'] : '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			$ids[ $key ] = $id;
			if ( ! empty( $page['template'] ) ) {
				update_post_meta( $id, '_wp_page_template', $page['template'] );
			}
		}
	}

	/* ---- Homepage statis + posts page ---- */
	if ( isset( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	if ( isset( $ids['blog'] ) ) {
		update_option( 'page_for_posts', $ids['blog'] );
	}

	/* ---- Menu utama ---- */
	$menu_name = 'Primary Menu';
	$menu      = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );

		$menu_items = array(
			array( 'title' => __( 'Home', 'zawa-digital' ), 'page' => 'home' ),
			array( 'title' => __( 'Services', 'zawa-digital' ), 'page' => 'services' ),
			array( 'title' => __( 'Case Studies', 'zawa-digital' ), 'page' => 'case-studies' ),
			array( 'title' => __( 'Blog', 'zawa-digital' ), 'page' => 'blog' ),
		);

		foreach ( $menu_items as $item ) {
			if ( isset( $ids[ $item['page'] ] ) ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => $item['title'],
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $ids[ $item['page'] ],
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				) );
			}
		}

		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		$locations['footer']  = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	/* ---- Permalink agar rapi ---- */
	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	update_option( 'zawa_demo_setup_done', 1 );
}
add_action( 'after_switch_theme', 'zawa_after_activation' );

/**
 * Notifikasi admin setelah setup.
 */
function zawa_setup_notice() {
	if ( ! get_option( 'zawa_demo_setup_done' ) || ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	if ( get_option( 'zawa_setup_notice_dismissed' ) ) {
		return;
	}
	?>
	<div class="notice notice-info is-dismissible" data-zawa-dismiss>
		<p>
			<strong><?php esc_html_e( 'Theme ZAWA Digital aktif!', 'zawa-digital' ); ?></strong>
			<?php esc_html_e( 'Halaman Home, Services, Case Studies, Blog & Request Quote beserta menu utama sudah dibuat otomatis.', 'zawa-digital' ); ?>
			<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><strong><?php esc_html_e( 'Buka Customizer untuk ganti logo & konten →', 'zawa-digital' ); ?></strong></a>
		</p>
	</div>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		var el = document.querySelector('[data-zawa-dismiss] .notice-dismiss');
		if (el) {
			el.addEventListener('click', function () {
				fetch('<?php echo esc_url( admin_url( 'admin-ajax.php?action=zawa_dismiss_notice&nonce=' . wp_create_nonce( 'zawa_dismiss' ) ) ); ?>');
			});
		}
	});
	</script>
	<?php
}
add_action( 'admin_notices', 'zawa_setup_notice' );

function zawa_dismiss_notice_ajax() {
	check_ajax_referer( 'zawa_dismiss', 'nonce' );
	update_option( 'zawa_setup_notice_dismissed', 1 );
	wp_die();
}
add_action( 'wp_ajax_zawa_dismiss_notice', 'zawa_dismiss_notice_ajax' );

/**
 * Konten default halaman Services.
 */
function zawa_default_services_content() {
	return <<<HTML
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.125rem"}}} -->
<p class="has-text-align-center">Whatever stage you are at — idea, growth, or scale — we have a service that fits. All delivered by one agile, collaborative team.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center">App Design &amp; Development</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Human-centered mobile and web applications. From UX research, UI design, prototyping, to development and launch — built for performance and scale.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Corporate Web Development</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Fast, secure, and elegant company websites that build trust — engineered with the latest web standards and easy for your team to manage.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">SEO &amp; GEO</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Be found first on search engines and AI-driven answers. Technical SEO, content strategy, and Generative Engine Optimization that compounds over time.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Online Media Placement</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Smart media buying across search, social, and publisher networks — planned, executed, and measured end-to-end.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Business Development Consultancy</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Strategic marketing roots that run deep. We help you define positioning, go-to-market plans, and growth engines that actually move the needle.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Campaign with KOL</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Data-driven Key Opinion Leader campaigns — from creator selection, negotiation, content direction, to reporting.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>…and other digital needs. If it lives on the internet, we can help you build it.</em></p>
<!-- /wp:paragraph -->
HTML;
}

/**
 * Konten default halaman Case Studies.
 */
function zawa_default_cases_content() {
	return <<<HTML
<!-- wp:paragraph -->
<p>A selection of partnerships we are proud of. Each one started with a conversation — <a href="/request-quote/">yours can too</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Cranserco</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Corporate identity and digital presence for a global trading partner — a clean, trustworthy platform that speaks to international markets.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">WingDik 300 TNI AU</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Official website and information system for the Indonesian Air Force education wing — secure, structured, and reliable.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">ICON+</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Integrated digital platform and campaign for a national network provider — connecting millions with seamless experience.</p>
<!-- /wp:paragraph -->
HTML;
}
