/* =====================================================================
   ZAWA DIGITAL — Customizer live preview
   ===================================================================== */
(function ($) {
	'use strict';

	// Site identity.
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.zawa-logo__img').attr('alt', to);
		});
	});

	// Sticky header on/off (desktop & mobile).
	wp.customize('zawa_sticky_desktop', function (value) {
		value.bind(function (to) {
			$('body').toggleClass('zawa-header-static-desktop', !to);
		});
	});
	wp.customize('zawa_sticky_mobile', function (value) {
		value.bind(function (to) {
			$('body').toggleClass('zawa-header-static-mobile', !to);
		});
	});

	function bindText(key, selector, html) {
		wp.customize(key, function (value) {
			value.bind(function (to) {
				$(selector)[html ? 'html' : 'text'](to);
			});
		});
	}

	bindText('zawa_hero_badge', '.zawa-hero .zawa-eyebrow', false);
	bindText('zawa_hero_title', '.zawa-hero__title', true);
	bindText('zawa_hero_text', '.zawa-hero__text', true);
	bindText('zawa_hero_btn_text', '.zawa-hero__actions .zawa-btn--primary', false);
	bindText('zawa_hero_btn2_text', '.zawa-hero__actions .zawa-btn--ghost', false);

	bindText('zawa_services_title', '.zawa-services .zawa-section__title', true);
	bindText('zawa_services_sub', '.zawa-services .zawa-section__sub', true);
	for (var i = 1; i <= 4; i++) {
		bindText('zawa_service' + i + '_t', '.zawa-service-card:nth-child(' + i + ') .zawa-service-card__title', true);
		bindText('zawa_service' + i + '_d', '.zawa-service-card:nth-child(' + i + ') .zawa-service-card__desc', true);
	}

	bindText('zawa_port_title', '.zawa-portfolio .zawa-section__title', true);
	bindText('zawa_port_sub', '.zawa-portfolio .zawa-section__sub', true);

	bindText('zawa_about_title', '.zawa-about .zawa-eyebrow', false);
	bindText('zawa_about_sub', '.zawa-about .zawa-section__title', true);

	bindText('zawa_team_title', '.zawa-team .zawa-section__title', true);
	bindText('zawa_team_sub', '.zawa-team .zawa-section__sub', true);

	bindText('zawa_cta_title', '.zawa-cta__title', true);
	bindText('zawa_cta_text', '.zawa-cta__text', true);
	bindText('zawa_cta_btn', '.zawa-cta__actions .zawa-btn--light', false);
})(jQuery);
