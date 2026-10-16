/* =====================================================================
   ZAWA DIGITAL — Main JS
   Mobile nav • sticky header • reveal on scroll • multi-step quote form
   ===================================================================== */
(function () {
	'use strict';

	document.documentElement.classList.add('zawa-js');
	document.body.classList.add('zawa-js');

	/* ---------- Mobile navigation ---------- */
	var burger = document.getElementById('zawa-burger');
	var nav = document.getElementById('zawa-nav');
	var backdrop = document.getElementById('zawa-nav-backdrop');

	function closeNav() {
		document.body.classList.remove('zawa-nav-open');
		if (burger) {
			burger.setAttribute('aria-expanded', 'false');
			burger.setAttribute('aria-label', 'Buka menu');
		}
	}

	if (burger && nav) {
		burger.addEventListener('click', function () {
			var open = document.body.classList.toggle('zawa-nav-open');
			burger.setAttribute('aria-expanded', open ? 'true' : 'false');
			burger.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
		});

		// Tutup saat link diklik.
		nav.addEventListener('click', function (e) {
			if (e.target.closest('a')) {
				closeNav();
			}
		});

		// Tutup lewat backdrop gelap.
		if (backdrop) {
			backdrop.addEventListener('click', closeNav);
		}

		// Tutup dengan Escape.
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') {
				closeNav();
			}
		});

		// Tutup saat klik di luar.
		document.addEventListener('click', function (e) {
			if (document.body.classList.contains('zawa-nav-open') &&
				!nav.contains(e.target) &&
				!burger.contains(e.target) &&
				!(backdrop && backdrop.contains(e.target))) {
				closeNav();
			}
		});

		// Pastikan drawer tertutup saat pindah ke tampilan desktop.
		window.addEventListener('resize', function () {
			if (window.innerWidth > 900) {
				closeNav();
			}
		});
	}

	/* ---------- Sub-menu toggle (mobile) ---------- */
	document.querySelectorAll('.zawa-nav__menu .menu-item-has-children > a').forEach(function (link) {
		link.addEventListener('click', function (e) {
			if (window.matchMedia('(max-width: 900px)').matches) {
				e.preventDefault();
				e.stopPropagation(); // jangan sampai drawer ikut tertutup.
				link.parentElement.classList.toggle('is-open');
				link.setAttribute('aria-expanded', link.parentElement.classList.contains('is-open') ? 'true' : 'false');
			}
		});
	});

	/* ---------- Sticky header shadow ---------- */
	var header = document.querySelector('.zawa-header');
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-stuck', window.scrollY > 8);
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	/* ---------- Reveal on scroll ---------- */
	var revealEls = document.querySelectorAll('.zawa-reveal');
	if ('IntersectionObserver' in window && revealEls.length) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
		revealEls.forEach(function (el) {
			io.observe(el);
		});
	} else {
		revealEls.forEach(function (el) {
			el.classList.add('is-visible');
		});
	}

	/* ---------- Animated counters ---------- */
	var counters = document.querySelectorAll('.zawa-count');
	function formatCount(el, val) {
		var dec = parseInt(el.getAttribute('data-decimals') || '0', 10) || 0;
		el.textContent = val.toLocaleString('en-US', { minimumFractionDigits: dec, maximumFractionDigits: dec });
	}
	function animateCount(el) {
		var target = parseFloat(el.getAttribute('data-count')) || 0;
		var dec = parseInt(el.getAttribute('data-decimals') || '0', 10) || 0;
		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			formatCount(el, target);
			return;
		}
		var duration = 1400;
		var start = null;
		var tick = function (ts) {
			if (start === null) { start = ts; }
			var p = Math.min((ts - start) / duration, 1);
			var eased = 1 - Math.pow(1 - p, 3); /* ease-out cubic */
			formatCount(el, parseFloat((target * eased).toFixed(dec)));
			if (p < 1) { requestAnimationFrame(tick); }
		};
		requestAnimationFrame(tick);
	}
	if (counters.length) {
		if ('IntersectionObserver' in window) {
			var countIO = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						animateCount(entry.target);
						countIO.unobserve(entry.target);
					}
				});
			}, { threshold: 0.4 });
			counters.forEach(function (el) { countIO.observe(el); });
		} else {
			counters.forEach(function (el) { animateCount(el); });
		}
	}

	/* ---------- Multi-step Request Quote ---------- */
	var form = document.getElementById('zawa-quote-form');
	if (form) {
		var steps = Array.prototype.slice.call(form.querySelectorAll('.zawa-quote-step'));
		var indicators = Array.prototype.slice.call(form.querySelectorAll('[data-step-indicator]'));
		var btnPrev = form.querySelector('[data-quote-prev]');
		var btnNext = form.querySelector('[data-quote-next]');
		var btnSubmit = form.querySelector('[data-quote-submit]');
		var current = 0;

		function goTo(index) {
			current = Math.max(0, Math.min(steps.length - 1, index));

			steps.forEach(function (step, i) {
				step.classList.toggle('is-active', i === current);
			});
			indicators.forEach(function (ind) {
				var n = parseInt(ind.getAttribute('data-step-indicator'), 10);
				ind.classList.toggle('is-active', n === current + 1);
				ind.classList.toggle('is-done', n < current + 1);
			});

			btnPrev.disabled = current === 0;
			btnNext.hidden = current === steps.length - 1;
			btnSubmit.hidden = current !== steps.length - 1;

			// Fokus field pertama yang terlihat.
			var firstField = steps[current].querySelector('input, textarea, select');
			if (firstField) {
				firstField.focus({ preventScroll: true });
			}
		}

		function stepIsValid() {
			var fields = Array.prototype.slice.call(steps[current].querySelectorAll('input, textarea, select'));
			var valid = true;
			fields.forEach(function (field) {
				if (!field.checkValidity()) {
					field.reportValidity();
					valid = false;
				}
			});
			return valid;
		}

		btnNext.addEventListener('click', function () {
			if (stepIsValid()) {
				goTo(current + 1);
			}
		});
		btnPrev.addEventListener('click', function () {
			goTo(current - 1);
		});

		// Enter pada input teks = lanjut step (bukan submit prematurely).
		form.addEventListener('keydown', function (e) {
			if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA' && !btnNext.hidden) {
				e.preventDefault();
				btnNext.click();
			}
		});

		goTo(0);
	}

	/* ---------- Back to top ---------- */
	// Anchor native (#masthead) bisa gagal di beberapa browser karena kombinasi
	// overflow/scroll-padding — jadi tombol ini SELALU di-handle JS: scroll mulus ke atas.
	document.querySelectorAll('.zawa-footer__backtop').forEach(function (btn) {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	});
})();
