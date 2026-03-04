<?php
/**
 * Plugin Name:       NExT Date Expiry Text Block
 * Description:       A block that displays custom text when a specified custom field date has passed. Supports full paragraph-level text styling.
 * Version:           0.3.1
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Author:            NExT-Season with WordPress Telex
 * Author URI:        https://next-season.net/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       next-date-expiry-block
 *
 * @package NextDateExpiryBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Loads the plugin text domain for translations.
 */
if ( ! function_exists( 'next_date_expiry_block_load_textdomain' ) ) {
	function next_date_expiry_block_load_textdomain() {
		load_plugin_textdomain(
			'next-date-expiry-block',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}
}
add_action( 'init', 'next_date_expiry_block_load_textdomain' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 */
if ( ! function_exists( 'next_date_expiry_block_block_init' ) ) {
	function next_date_expiry_block_block_init() {
		register_block_type( __DIR__ . '/build/' );
	}
}
add_action( 'init', 'next_date_expiry_block_block_init' );
