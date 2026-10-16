<?php
/**
 * Template Name: Request Quote (Multi-step)
 * Template Post Type: page
 *
 * Form permintaan penawaran — terinspirasi cranserco.com/request-quote.
 * Submit dikirim via email ke alamat di Customizer + tersedia opsi WhatsApp.
 *
 * @package Zawa_Digital
 */

get_header();
?>

<div class="zawa-page-hero">
	<div class="zawa-container">
		<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Let&rsquo;s talk', 'zawa-digital' ); ?></p>
		<h1 class="zawa-page-hero__title"><?php the_title(); ?></h1>
		<p class="zawa-page-hero__sub"><?php esc_html_e( 'Three quick steps — tell us what you need and we will get back within one business day.', 'zawa-digital' ); ?></p>
	</div>
</div>

<div class="zawa-container zawa-quote-wrap">

	<?php if ( isset( $_GET['quote'] ) && 'success' === $_GET['quote'] ) : ?>

		<div class="zawa-quote-success" role="status">
			<div class="zawa-quote-success__icon"><?php echo zawa_icon( 'check', 32 ); ?></div>
			<h2><?php esc_html_e( 'Request received!', 'zawa-digital' ); ?></h2>
			<p><?php esc_html_e( 'Thank you — our team will review your request and reply to your email shortly.', 'zawa-digital' ); ?></p>
			<a class="zawa-btn zawa-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Back to homepage', 'zawa-digital' ); ?> <?php echo zawa_icon( 'arrow', 18 ); ?>
			</a>
		</div>

	<?php else : ?>

	<form class="zawa-quote-form" id="zawa-quote-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<?php wp_nonce_field( 'zawa_quote', 'zawa_quote_nonce' ); ?>
		<input type="hidden" name="action" value="zawa_quote_submit">

		<div class="zawa-quote-steps" aria-hidden="true">
			<span class="zawa-quote-steps__item is-active" data-step-indicator="1"><i>1</i> <?php esc_html_e( 'Service', 'zawa-digital' ); ?></span>
			<span class="zawa-quote-steps__bar"></span>
			<span class="zawa-quote-steps__item" data-step-indicator="2"><i>2</i> <?php esc_html_e( 'Project', 'zawa-digital' ); ?></span>
			<span class="zawa-quote-steps__bar"></span>
			<span class="zawa-quote-steps__item" data-step-indicator="3"><i>3</i> <?php esc_html_e( 'Contact', 'zawa-digital' ); ?></span>
		</div>

		<!-- STEP 1 : Layanan -->
		<fieldset class="zawa-quote-step is-active" data-step="1">
			<legend><?php esc_html_e( 'Which service do you need?', 'zawa-digital' ); ?></legend>
			<div class="zawa-choice-grid">
				<?php
				$services = array(
					'app'         => __( 'App Design & Development', 'zawa-digital' ),
					'web'         => __( 'Corporate Web Development', 'zawa-digital' ),
					'seo'         => __( 'SEO & GEO', 'zawa-digital' ),
					'media'       => __( 'Online Media Placement', 'zawa-digital' ),
					'consultancy' => __( 'Business Development Consultancy', 'zawa-digital' ),
					'kol'         => __( 'Campaign with KOL', 'zawa-digital' ),
					'other'       => __( 'Something else', 'zawa-digital' ),
				);
				foreach ( $services as $value => $label ) :
					?>
					<label class="zawa-choice">
						<input type="radio" name="zawa_service" value="<?php echo esc_attr( $label ); ?>" required>
						<span><?php echo zawa_icon( 'check', 18 ); ?><?php echo esc_html( $label ); ?></span>
					</label>
				<?php endforeach; ?>
			</div>
		</fieldset>

		<!-- STEP 2 : Proyek -->
		<fieldset class="zawa-quote-step" data-step="2">
			<legend><?php esc_html_e( 'Tell us about the project', 'zawa-digital' ); ?></legend>

			<div class="zawa-quote-field">
				<label for="zawa-goal"><?php esc_html_e( 'What are your goals?', 'zawa-digital' ); ?></label>
				<textarea id="zawa-goal" name="zawa_goal" rows="4" placeholder="<?php esc_attr_e( 'e.g. New company website with SEO, launch campaign, MVP app…', 'zawa-digital' ); ?>" required></textarea>
			</div>

			<div class="zawa-quote-row">
				<div class="zawa-quote-field">
					<label for="zawa-budget"><?php esc_html_e( 'Estimated budget', 'zawa-digital' ); ?></label>
					<select id="zawa-budget" name="zawa_budget" required>
						<option value=""><?php esc_html_e( 'Select range…', 'zawa-digital' ); ?></option>
						<option>&lt; Rp 10 Juta</option>
						<option>Rp 10 – 50 Juta</option>
						<option>Rp 50 – 150 Juta</option>
						<option>&gt; Rp 150 Juta</option>
						<option><?php esc_html_e( 'Not sure yet', 'zawa-digital' ); ?></option>
					</select>
				</div>
				<div class="zawa-quote-field">
					<label for="zawa-timeline"><?php esc_html_e( 'Expected timeline', 'zawa-digital' ); ?></label>
					<select id="zawa-timeline" name="zawa_timeline" required>
						<option value=""><?php esc_html_e( 'Select…', 'zawa-digital' ); ?></option>
						<option><?php esc_html_e( 'ASAP', 'zawa-digital' ); ?></option>
						<option><?php esc_html_e( '1–3 months', 'zawa-digital' ); ?></option>
						<option><?php esc_html_e( '3–6 months', 'zawa-digital' ); ?></option>
						<option><?php esc_html_e( 'Flexible', 'zawa-digital' ); ?></option>
					</select>
				</div>
			</div>
		</fieldset>

		<!-- STEP 3 : Kontak -->
		<fieldset class="zawa-quote-step" data-step="3">
			<legend><?php esc_html_e( 'How can we reach you?', 'zawa-digital' ); ?></legend>

			<div class="zawa-quote-row">
				<div class="zawa-quote-field">
					<label for="zawa-name"><?php esc_html_e( 'Full name *', 'zawa-digital' ); ?></label>
					<input type="text" id="zawa-name" name="zawa_name" autocomplete="name" required>
				</div>
				<div class="zawa-quote-field">
					<label for="zawa-company"><?php esc_html_e( 'Company', 'zawa-digital' ); ?></label>
					<input type="text" id="zawa-company" name="zawa_company" autocomplete="organization">
				</div>
			</div>

			<div class="zawa-quote-row">
				<div class="zawa-quote-field">
					<label for="zawa-email"><?php esc_html_e( 'Email *', 'zawa-digital' ); ?></label>
					<input type="email" id="zawa-email" name="zawa_email" autocomplete="email" required>
				</div>
				<div class="zawa-quote-field">
					<label for="zawa-phone"><?php esc_html_e( 'Phone / WhatsApp', 'zawa-digital' ); ?></label>
					<input type="tel" id="zawa-phone" name="zawa_phone" autocomplete="tel">
				</div>
			</div>

			<p class="zawa-quote-note">
				<?php esc_html_e( 'By submitting, you agree to be contacted regarding your request. We never share your data.', 'zawa-digital' ); ?>
			</p>
		</fieldset>

		<div class="zawa-quote-nav">
			<button type="button" class="zawa-btn zawa-btn--ghost" data-quote-prev disabled>
				<?php esc_html_e( 'Back', 'zawa-digital' ); ?>
			</button>
			<button type="button" class="zawa-btn zawa-btn--primary" data-quote-next>
				<?php esc_html_e( 'Continue', 'zawa-digital' ); ?> <?php echo zawa_icon( 'arrow', 18 ); ?>
			</button>
			<button type="submit" class="zawa-btn zawa-btn--primary" data-quote-submit hidden>
				<?php echo zawa_icon( 'spark', 18 ); ?>
				<?php esc_html_e( 'Send request', 'zawa-digital' ); ?>
			</button>
		</div>
	</form>

	<div class="zawa-quote-alt">
		<p><?php esc_html_e( 'Prefer chatting?', 'zawa-digital' ); ?></p>
		<a class="zawa-btn zawa-btn--wa" href="<?php echo esc_url( zawa_whatsapp_link( 'Halo ZAWA Digital, saya ingin request quote.' ) ); ?>" target="_blank" rel="noopener">
			<?php echo zawa_icon( 'whatsapp', 20 ); ?>
			<?php esc_html_e( 'Chat via WhatsApp', 'zawa-digital' ); ?>
		</a>
	</div>

	<?php endif; ?>

</div>

<?php
get_footer();
