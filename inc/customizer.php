<?php
/**
 * ZAWA Digital — Customizer options.
 * Semua konten default homepage, info kontak & floating button bisa diubah
 * dari Appearance → Customize tanpa menyentuh kode.
 *
 * @package Zawa_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Default konten (diambil dari dokumen konsep ZAWA Digital) ---------------- */

function zawa_defaults() {
	return array(
		// Hero.
		'zawa_hero_badge'      => __( 'Digital Strategy Partner', 'zawa-digital' ),
		'zawa_hero_title'      => __( 'We help businesses thrive in a digital-first world.', 'zawa-digital' ),
		'zawa_hero_text'       => __( 'From strategic marketing to digital campaigns and application development — ZAWA Digital is your full-service partner to reach your highest business goals.', 'zawa-digital' ),
		'zawa_hero_btn_text'   => __( 'Request a Quote', 'zawa-digital' ),
		'zawa_hero_btn2_text'  => __( 'Explore Services', 'zawa-digital' ),

		// Services.
		'zawa_services_title'  => __( 'What we do', 'zawa-digital' ),
		'zawa_services_sub'    => __( 'Full-service digital solutions, delivered by an agile team.', 'zawa-digital' ),
		'zawa_service1_t'      => __( 'App Design & Development', 'zawa-digital' ),
		'zawa_service1_d'      => __( 'Human-centered mobile & web applications — from UX research to launch.', 'zawa-digital' ),
		'zawa_service2_t'      => __( 'Corporate Web Development', 'zawa-digital' ),
		'zawa_service2_d'      => __( 'Fast, secure and elegant company websites that build trust.', 'zawa-digital' ),
		'zawa_service3_t'      => __( 'SEO & GEO', 'zawa-digital' ),
		'zawa_service3_d'      => __( 'Be found first. Search & generative-engine optimization that compounds.', 'zawa-digital' ),
		'zawa_service4_t'      => __( 'Campaign with KOL', 'zawa-digital' ),
		'zawa_service4_d'      => __( 'Data-driven influencer & online media campaigns that convert.', 'zawa-digital' ),

		// Portfolio.
		'zawa_port_title'      => __( 'Selected works', 'zawa-digital' ),
		'zawa_port_sub'        => __( 'A few stories we are proud of.', 'zawa-digital' ),
		'zawa_port1_t'         => 'Cranserco',
		'zawa_port1_d'         => __( 'Corporate identity & digital presence for a global trading partner.', 'zawa-digital' ),
		'zawa_port2_t'         => 'WingDik 300 TNI AU',
		'zawa_port2_d'         => __( 'Official website & information system for the Indonesian Air Force education wing.', 'zawa-digital' ),
		'zawa_port3_t'         => 'ICON+',
		'zawa_port3_d'         => __( 'Integrated digital platform & campaign for a national network provider.', 'zawa-digital' ),
		'zawa_port4_t'         => __( 'Your project', 'zawa-digital' ),
		'zawa_port4_d'         => __( 'The next success story could be yours. Let&rsquo;s build it together.', 'zawa-digital' ),

		// About.
		'zawa_about_title'     => __( 'About us', 'zawa-digital' ),
		'zawa_about_sub'       => __( 'From agile freelancers to a full-service digital strategy partner.', 'zawa-digital' ),
		'zawa_about_p1'        => __( 'What began as a collaborative team of agile freelancers has evolved into a full-service digital strategy partner.', 'zawa-digital' ),
		'zawa_about_p2'        => __( 'Building on our deep roots in strategic marketing, we expanded our expertise into digital marketing and application development to help businesses thrive in a digital-first world.', 'zawa-digital' ),
		'zawa_about_p3'        => __( 'As technology and market demands evolve, so do we — technically and strategically. Yet, our core commitment remains unchanged: a relentless passion for understanding our clients&rsquo; needs and helping them achieve their highest business goals.', 'zawa-digital' ),

		// Team.
		'zawa_team_title'      => __( 'The team', 'zawa-digital' ),
		'zawa_team_sub'        => __( 'Strategy, design and engineering under one roof.', 'zawa-digital' ),
		'zawa_team1_t'         => __( 'Strategy Lead', 'zawa-digital' ),
		'zawa_team2_t'         => __( 'Creative Director', 'zawa-digital' ),
		'zawa_team3_t'         => __( 'Technology Lead', 'zawa-digital' ),

		// CTA.
		'zawa_cta_title'       => __( 'Have a project in mind?', 'zawa-digital' ),
		'zawa_cta_text'        => __( 'Tell us about your goals — we will reply within one business day.', 'zawa-digital' ),
		'zawa_cta_btn'         => __( 'Request a Quote', 'zawa-digital' ),

		// Header & navigasi.
		'zawa_sticky_desktop'  => 1,
		'zawa_sticky_mobile'   => 1,

		// Kontak & footer.
		'zawa_wa_number'       => '6281321873330',
		'zawa_email'           => 'zawa.web.seo@gmail.com',
		'zawa_address'         => 'Jl. Tubagus Ismail, Sekeloa, Coblong, Kota Bandung',
		'zawa_footer_about'    => __( 'ZAWA Digital — full-service digital strategy partner. Strategy, marketing, and application development for a digital-first world.', 'zawa-digital' ),
		'zawa_socials'         => array(),
		'zawa_copyright'       => __( '© {year} ZAWA Digital. All rights reserved.', 'zawa-digital' ),

		// Floating button.
		'zawa_float_enable'    => 1,
		'zawa_float_label'     => __( 'Request Quote', 'zawa-digital' ),
	);
}

function zawa_get_option( $key ) {
	$defaults = zawa_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( $key, $default );
}

/* Register ----------------------------------------------------------------- */

function zawa_customize_register( $wp_customize ) {

	$defaults = zawa_defaults();

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$panel = 'zawa_options';
	$wp_customize->add_panel( $panel, array(
		'title'       => __( 'ZAWA Digital — Pengaturan Theme', 'zawa-digital' ),
		'description' => __( 'Logo bisa diganti di bagian "Site Identity". Konten di bawah hanya tampil bila homepage BELUM dibangun dengan Elementor.', 'zawa-digital' ),
		'priority'    => 10,
	) );

	/* Helper: tambahkan setting+control cepat. */
	$add_field = function ( $id, $label, $section, $type = 'text', $extra = array() ) use ( $wp_customize, $defaults ) {
		$sanitize = 'sanitize_text_field';
		if ( 'textarea' === $type ) {
			$sanitize = 'wp_kses_post';
		} elseif ( 'url' === $type ) {
			$sanitize = 'esc_url_raw';
		} elseif ( 'checkbox' === $type ) {
			$sanitize = 'zawa_sanitize_checkbox';
		} elseif ( 'image' === $type ) {
			$sanitize = 'absint';
		} elseif ( 'number' === $type ) {
			$sanitize = 'zawa_sanitize_int';
		}

		$wp_customize->add_setting( $id, array(
			'default'           => isset( $defaults[ $id ] ) ? $defaults[ $id ] : '',
			'sanitize_callback' => $sanitize,
		) );

		if ( 'image' === $type ) {
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array_merge( array(
				'label'   => $label,
				'section' => $section,
			), $extra ) ) );
		} elseif ( 'checkbox' === $type ) {
			$wp_customize->add_control( $id, array_merge( array(
				'label'   => $label,
				'section' => $section,
				'type'    => 'checkbox',
			), $extra ) );
		} else {
			$wp_customize->add_control( $id, array_merge( array(
				'label'   => $label,
				'section' => $section,
				'type'    => $type,
			), $extra ) );
		}
	};

	/* ============ SECTION: HEADER & MENU (STICKY) ============ */
	$s = 'zawa_sec_header';
	$wp_customize->add_section( $s, array(
		'title'       => __( 'Header & Menu (Sticky)', 'zawa-digital' ),
		'description' => __( 'Centang = header menempel di atas saat scroll (sticky). Hilangkan centang untuk membuat header ikut ter-scroll (non-aktif). Berlaku terpisah untuk desktop dan mobile.', 'zawa-digital' ),
		'panel'       => $panel,
		'priority'    => 5,
	) );
	foreach ( array(
		'zawa_sticky_desktop' => __( 'Sticky header — Desktop', 'zawa-digital' ),
		'zawa_sticky_mobile'  => __( 'Sticky header — Mobile', 'zawa-digital' ),
	) as $sticky_id => $sticky_label ) {
		$wp_customize->add_setting( $sticky_id, array(
			'default'           => 1,
			'sanitize_callback' => 'zawa_sanitize_checkbox',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $sticky_id, array(
			'label'   => $sticky_label,
			'section' => $s,
			'type'    => 'checkbox',
		) );
	}

	/* ============ SECTION: HERO ============ */
	$s = 'zawa_sec_hero';
	$wp_customize->add_section( $s, array( 'title' => __( 'Homepage — Hero', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_hero_badge', __( 'Badge kecil', 'zawa-digital' ), $s );
	$add_field( 'zawa_hero_title', __( 'Judul besar', 'zawa-digital' ), $s, 'textarea' );
	$add_field( 'zawa_hero_text', __( 'Teks deskriptif', 'zawa-digital' ), $s, 'textarea' );
	$add_field( 'zawa_hero_image', __( 'Gambar besar hero', 'zawa-digital' ), $s, 'image' );
	$add_field( 'zawa_hero_btn_text', __( 'Tombol utama — teks', 'zawa-digital' ), $s );
	$add_field( 'zawa_hero_btn_url', __( 'Tombol utama — link', 'zawa-digital' ), $s, 'url' );
	$add_field( 'zawa_hero_btn2_text', __( 'Tombol kedua — teks', 'zawa-digital' ), $s );
	$add_field( 'zawa_hero_btn2_url', __( 'Tombol kedua — link', 'zawa-digital' ), $s, 'url' );

	/* ============ SECTION: SERVICES (2x2) ============ */
	$s = 'zawa_sec_services';
	$wp_customize->add_section( $s, array( 'title' => __( 'Homepage — Services (2×2)', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_services_title', __( 'Judul section', 'zawa-digital' ), $s );
	$add_field( 'zawa_services_sub', __( 'Sub-judul', 'zawa-digital' ), $s );
	$add_field( 'zawa_services_url', __( 'Link tombol "All Services"', 'zawa-digital' ), $s, 'url' );
	for ( $i = 1; $i <= 4; $i++ ) {
		$add_field( "zawa_service{$i}_t", sprintf( __( 'Layanan %d — judul', 'zawa-digital' ), $i ), $s );
		$add_field( "zawa_service{$i}_d", sprintf( __( 'Layanan %d — deskripsi', 'zawa-digital' ), $i ), $s, 'textarea' );
	}

	/* ============ SECTION: PORTFOLIO ============ */
	$s = 'zawa_sec_port';
	$wp_customize->add_section( $s, array( 'title' => __( 'Homepage — Portfolio', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_port_title', __( 'Judul section', 'zawa-digital' ), $s );
	$add_field( 'zawa_port_sub', __( 'Sub-judul', 'zawa-digital' ), $s );
	for ( $i = 1; $i <= 4; $i++ ) {
		$add_field( "zawa_port{$i}_t", sprintf( __( 'Portfolio %d — judul', 'zawa-digital' ), $i ), $s );
		$add_field( "zawa_port{$i}_d", sprintf( __( 'Portfolio %d — deskripsi', 'zawa-digital' ), $i ), $s, 'textarea' );
		$add_field( "zawa_port{$i}_img", sprintf( __( 'Portfolio %d — gambar', 'zawa-digital' ), $i ), $s, 'image' );
		$add_field( "zawa_port{$i}_url", sprintf( __( 'Portfolio %d — link', 'zawa-digital' ), $i ), $s, 'url' );
	}

	/* ============ SECTION: ABOUT ============ */
	$s = 'zawa_sec_about';
	$wp_customize->add_section( $s, array( 'title' => __( 'Homepage — About Us', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_about_title', __( 'Judul section', 'zawa-digital' ), $s );
	$add_field( 'zawa_about_sub', __( 'Sub-judul', 'zawa-digital' ), $s );
	$add_field( 'zawa_about_p1', __( 'Paragraf 1', 'zawa-digital' ), $s, 'textarea' );
	$add_field( 'zawa_about_p2', __( 'Paragraf 2', 'zawa-digital' ), $s, 'textarea' );
	$add_field( 'zawa_about_p3', __( 'Paragraf 3', 'zawa-digital' ), $s, 'textarea' );
	$add_field( 'zawa_about_image', __( 'Gambar pendukung', 'zawa-digital' ), $s, 'image' );

	/* ============ SECTION: TEAM (3x1) ============ */
	$s = 'zawa_sec_team';
	$wp_customize->add_section( $s, array( 'title' => __( 'Homepage — Teams (3×1)', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_team_title', __( 'Judul section', 'zawa-digital' ), $s );
	$add_field( 'zawa_team_sub', __( 'Sub-judul', 'zawa-digital' ), $s );
	for ( $i = 1; $i <= 3; $i++ ) {
		$add_field( "zawa_team{$i}_n", sprintf( __( 'Anggota %d — nama', 'zawa-digital' ), $i ), $s );
		$add_field( "zawa_team{$i}_t", sprintf( __( 'Anggota %d — jabatan', 'zawa-digital' ), $i ), $s );
		$add_field( "zawa_team{$i}_img", sprintf( __( 'Anggota %d — foto', 'zawa-digital' ), $i ), $s, 'image' );
	}

	/* ============ SECTION: CTA ============ */
	$s = 'zawa_sec_cta';
	$wp_customize->add_section( $s, array( 'title' => __( 'Homepage — CTA Band', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_cta_title', __( 'Judul', 'zawa-digital' ), $s );
	$add_field( 'zawa_cta_text', __( 'Teks', 'zawa-digital' ), $s, 'textarea' );
	$add_field( 'zawa_cta_btn', __( 'Teks tombol', 'zawa-digital' ), $s );
	$add_field( 'zawa_quote_url', __( 'Link tombol Request Quote (global)', 'zawa-digital' ), $s, 'url' );

	/* ============ SECTION: KONTAK & FOOTER ============ */
	$s = 'zawa_sec_footer';
	$wp_customize->add_section( $s, array( 'title' => __( 'Kontak & Footer', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_wa_number', __( 'Nomor WhatsApp (awali 62…)', 'zawa-digital' ), $s );
	$add_field( 'zawa_email', __( 'Email', 'zawa-digital' ), $s );
	$add_field( 'zawa_address', __( 'Alamat', 'zawa-digital' ), $s, 'textarea' );
	$add_field( 'zawa_footer_about', __( 'Deskripsi singkat di footer', 'zawa-digital' ), $s, 'textarea' );

	/* Repeater Social Media — tiap item: ikon + nama + link URL */
	$wp_customize->add_setting( 'zawa_socials', array(
		'default'           => array(),
		'sanitize_callback' => 'zawa_sanitize_socials',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new Zawa_Social_Repeater_Control( $wp_customize, 'zawa_socials', array(
		'section'      => $s,
		'label'        => __( 'Social Media Footer', 'zawa-digital' ),
		'description'  => __( 'Tambah / hapus sosial media — tiap item punya ikon, nama, dan link URL. Panah ↑ ↓ untuk mengatur urutan tampil.', 'zawa-digital' ),
		'icon_choices' => array(
			'whatsapp'  => 'WhatsApp',
			'instagram' => 'Instagram',
			'facebook'  => 'Facebook',
			'linkedin'  => 'LinkedIn',
			'x'         => 'X (Twitter)',
			'tiktok'    => 'TikTok',
			'youtube'   => 'YouTube',
			'globe'     => 'Website',
			'mail'      => 'Email',
			'phone'     => 'Telepon',
		),
	) ) );
	$add_field( 'zawa_copyright', __( 'Copyright (gunakan {year} untuk tahun otomatis)', 'zawa-digital' ), $s );

	/* ============ SECTION: FLOATING BUTTON ============ */
	$s = 'zawa_sec_float';
	$wp_customize->add_section( $s, array( 'title' => __( 'Floating Button', 'zawa-digital' ), 'panel' => $panel ) );
	$add_field( 'zawa_float_enable', __( 'Tampilkan tombol melayang "Request Quote" (khusus mobile — desktop otomatis memakai tombol di header)', 'zawa-digital' ), $s, 'checkbox' );
	$add_field( 'zawa_float_label', __( 'Label tombol', 'zawa-digital' ), $s );
}
add_action( 'customize_register', 'zawa_customize_register' );

/* Sanitize ------------------------------------------------------------------ */

function zawa_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === (bool) $checked );
}

function zawa_sanitize_int( $value ) {
	return absint( $value );
}

function zawa_sanitize_socials( $input ) {
	if ( is_string( $input ) ) {
		$input = json_decode( wp_unslash( $input ), true );
	}
	if ( ! is_array( $input ) ) {
		return array();
	}
	$out = array();
	foreach ( $input as $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}
		$out[] = array(
			'icon' => isset( $item['icon'] ) ? sanitize_key( $item['icon'] ) : '',
			'name' => isset( $item['name'] ) ? sanitize_text_field( wp_unslash( $item['name'] ) ) : '',
			'url'  => isset( $item['url'] ) ? esc_url_raw( wp_unslash( $item['url'] ) ) : '',
		);
	}
	return $out;
}

/* Repeater Control: Social Media (ikon + nama + URL) ---------------------------------- */

/* Kelas customizer hanya boleh didefinisikan saat WordPress memuat
   lingkungan Customizer — di halaman biasa kelas induk WP_Customize_Control
   belum ada sehingga tanpa guard ini terjadi fatal error di semua request. */
if ( class_exists( 'WP_Customize_Control' ) ) :
	class Zawa_Social_Repeater_Control extends WP_Customize_Control {

	public $type = 'zawa_social_repeater';

	public $icon_choices = array();

	public function render_content() {
		$value = $this->value();
		if ( is_string( $value ) ) {
			$value = json_decode( $value, true );
		}
		if ( ! is_array( $value ) || empty( $value ) ) {
			$value = zawa_footer_socials(); // Baris awal saat belum pernah disimpan.
		}
		?>
		<style>
			.zawa-sr__row { border:1px solid #c3c4c7; border-radius:4px; padding:8px 8px 4px; margin-bottom:8px; background:#fff; }
			.zawa-sr__head { display:flex; align-items:center; gap:4px; margin-bottom:6px; }
			.zawa-sr__title { flex:1; font-weight:600; }
			.zawa-sr__up, .zawa-sr__down, .zawa-sr__remove { width:26px; height:26px; padding:0; line-height:1; border:1px solid #c3c4c7; background:#f6f7f7; border-radius:3px; cursor:pointer; }
			.zawa-sr__row select, .zawa-sr__row input { width:100%; margin-bottom:4px; }
			.zawa-sr__add { margin-top:4px; }
		</style>
		<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>
		<?php if ( $this->description ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>
		<div class="zawa-sr" data-icon-choices="<?php echo esc_attr( wp_json_encode( $this->icon_choices ) ); ?>">
			<div class="zawa-sr__rows"></div>
			<button type="button" class="button button-secondary zawa-sr__add"><?php esc_html_e( '+ Tambah Sosial', 'zawa-digital' ); ?></button>
			<input type="hidden" class="zawa-sr__value" <?php $this->link(); ?> value="<?php echo esc_attr( wp_json_encode( array_values( $value ) ) ); ?>">
		</div>
		<script>
		(function () {
			if (window.__zawaSocialRepeater) { return;}
			window.__zawaSocialRepeater = true;
			window.zawaSocialRepeaterSetup = function (root) {
				if (root.dataset.init) { return;}
				root.dataset.init = '1';
				var rowsEl = root.querySelector('.zawa-sr__rows');
				var hidden = root.querySelector('.zawa-sr__value');
				var choices = {};
				try { choices = JSON.parse(root.dataset.iconChoices || '{}'); } catch (e) {}
				function sync() {
					var data = [];
					rowsEl.querySelectorAll('.zawa-sr__row').forEach(function (row) {
						data.push({
							icon: row.querySelector('.zawa-sr__icon').value,
							name: row.querySelector('.zawa-sr__name').value,
							url: row.querySelector('.zawa-sr__url').value
						});
					});
					hidden.value = JSON.stringify(data);
					hidden.dispatchEvent(new Event('change', {bubbles: true}));
				}
				function optionsHtml(sel) {
					var h = '';
					Object.keys(choices).forEach(function (k) {
						h += '<option value="' + k + '"' + (k === sel ? ' selected' : '') + '>' + choices[k] + '</option>';
					});
					return h;
				}
				function addRow(item) {
					item = item || {};
					var row = document.createElement('div');
					row.className = 'zawa-sr__row';
					row.innerHTML = '<div class="zawa-sr__head">' +
						'<span class="zawa-sr__title"></span>' +
						'<button type="button" class="zawa-sr__up" title="Naikkan">&#8593;</button>' +
						'<button type="button" class="zawa-sr__down" title="Turunkan">&#8595;</button>' +
						'<button type="button" class="zawa-sr__remove" title="Hapus">&#215;</button>' +
					'</div>' +
					'<select class="zawa-sr__icon"></select>' +
					'<input type="text" class="zawa-sr__name" placeholder="Nama (mis. Instagram)" />' +
					'<input type="url" class="zawa-sr__url" placeholder="https://link-sosmed.com/profil" />';
					row.querySelector('.zawa-sr__icon').innerHTML = optionsHtml(item.icon || 'instagram');
					row.querySelector('.zawa-sr__name').value = item.name || '';
					row.querySelector('.zawa-sr__url').value = item.url || '';
					var sel = row.querySelector('.zawa-sr__icon');
					function setTitle() {
						row.querySelector('.zawa-sr__title').textContent = (choices[sel.value] || 'Sosial');
					}
					setTitle();
					row.addEventListener('input', sync);
					sel.addEventListener('change', function () { setTitle(); sync(); });
					row.querySelector('.zawa-sr__remove').addEventListener('click', function () { row.remove(); sync(); });
					row.querySelector('.zawa-sr__up').addEventListener('click', function () {
						var p = row.previousElementSibling;
						if (p) { rowsEl.insertBefore(row, p); sync(); }
					});
					row.querySelector('.zawa-sr__down').addEventListener('click', function () {
						var n = row.nextElementSibling;
						if (n) { rowsEl.insertBefore(n, row); sync(); }
					});
					rowsEl.appendChild(row);
				}
				var initial = [];
				try { initial = JSON.parse(hidden.value || '[]'); } catch (e) {}
				initial.forEach(addRow);
				root.querySelector('.zawa-sr__add').addEventListener('click', function () {
					addRow({icon: 'instagram', name: '', url: ''});
					sync();
					root.querySelector('.zawa-sr__rows:last-child .zawa-sr__name').focus();
				});
			};
			document.querySelectorAll('.zawa-sr').forEach(window.zawaSocialRepeaterSetup);
		})();
		</script>
		<?php
	}
	}
endif;

/* Live preview JS ----------------------------------------------------------- */

function zawa_customize_preview_js() {
	wp_enqueue_script( 'zawa-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), ZAWA_VERSION, true );
}
add_action( 'customize_preview_init', 'zawa_customize_preview_js' );
