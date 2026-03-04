<?php
/**
 * Server-side rendering for the Date Expiry Text Block.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$custom_field_name = isset( $attributes['customFieldName'] ) ? sanitize_text_field( $attributes['customFieldName'] ) : '';
$date_format       = isset( $attributes['dateFormat'] ) ? sanitize_text_field( $attributes['dateFormat'] ) : 'Y-m-d';
$text_content      = isset( $attributes['content'] ) ? wp_kses_post( $attributes['content'] ) : '';
$text_align        = isset( $attributes['textAlign'] ) ? $attributes['textAlign'] : '';

// If no custom field name is set, render nothing.
if ( empty( $custom_field_name ) ) {
	return;
}

// If no content is set, render nothing.
if ( empty( $text_content ) ) {
	return;
}

// Get the current post ID.
$post_id = get_the_ID();

if ( ! $post_id ) {
	return;
}

// Retrieve the custom field value.
$field_value = get_post_meta( $post_id, $custom_field_name, true );

if ( empty( $field_value ) ) {
	return;
}

// Parse the date from the custom field.
$expiry_date = DateTime::createFromFormat( $date_format, $field_value );

if ( ! $expiry_date ) {
	// Try standard strtotime as a fallback.
	$timestamp = strtotime( $field_value );
	if ( false === $timestamp ) {
		return;
	}
	$expiry_date = new DateTime();
	$expiry_date->setTimestamp( $timestamp );
}

// Reset time to end of day for fair comparison.
$expiry_date->setTime( 23, 59, 59 );

$now = new DateTime( 'now', wp_timezone() );

// Only display if the expiry date has passed.
if ( $expiry_date >= $now ) {
	return;
}

// Build inline styles for text alignment.
$inline_style = '';
if ( ! empty( $text_align ) ) {
	$inline_style = 'text-align:' . esc_attr( $text_align ) . ';';
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'style' => $inline_style,
	)
);
?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Sanitized by get_block_wrapper_attributes(). ?>>
	<p><?php echo wp_kses_post( $text_content ); ?></p>
</div>
