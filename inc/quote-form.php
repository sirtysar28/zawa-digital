<?php
/**
 * Handler form Request Quote — kirim email ke alamat Customizer.
 *
 * @package Zawa_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function zawa_handle_quote_submit() {
	if ( ! isset( $_POST['zawa_quote_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['zawa_quote_nonce'] ), 'zawa_quote' ) ) {
		wp_safe_redirect( home_url( '/request-quote/?quote=error#zawa-quote-form' ) );
		exit;
	}

	$fields = array(
		'zawa_service'  => 'text',
		'zawa_goal'     => 'textarea',
		'zawa_budget'   => 'text',
		'zawa_timeline' => 'text',
		'zawa_name'     => 'text',
		'zawa_company'  => 'text',
		'zawa_email'    => 'email',
		'zawa_phone'    => 'text',
	);

	$data = array();
	foreach ( $fields as $key => $type ) {
		$raw      = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
		$data[ $key ] = 'textarea' === $type ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw );
		if ( 'email' === $type ) {
			$data[ $key ] = sanitize_email( $raw );
		}
	}

	$to      = zawa_get_option( 'zawa_email' );
	$to      = $to ? $to : get_option( 'admin_email' );
	$subject = sprintf( '[%s] New quote request from %s', wp_specialchars_decode( get_bloginfo( 'name' ) ), $data['zawa_name'] );

	$body  = "New quote request via website:\n\n";
	$body .= "Service:  {$data['zawa_service']}\n";
	$body .= "Budget:   {$data['zawa_budget']}\n";
	$body .= "Timeline: {$data['zawa_timeline']}\n\n";
	$body .= "Goals:\n{$data['zawa_goal']}\n\n";
	$body .= "---\n";
	$body .= "Name:    {$data['zawa_name']}\n";
	$body .= "Company: {$data['zawa_company']}\n";
	$body .= "Email:   {$data['zawa_email']}\n";
	$body .= "Phone:   {$data['zawa_phone']}\n";

	$headers = array( 'Reply-To: ' . $data['zawa_name'] . ' <' . $data['zawa_email'] . '>' );

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'quote', 'success', wp_get_referer() ? wp_get_referer() : home_url( '/request-quote/' ) ) );
	exit;
}
add_action( 'admin_post_nopriv_zawa_quote_submit', 'zawa_handle_quote_submit' );
add_action( 'admin_post_zawa_quote_submit', 'zawa_handle_quote_submit' );
