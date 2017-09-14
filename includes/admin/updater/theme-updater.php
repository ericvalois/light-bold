<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'Light_Bold_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// The theme version to use in the updater
define( 'LIGHT_BOLD_SL_THEME_VERSION', wp_get_theme( 'light-bold' )->get( 'Version' ) );

// Loads the updater classes
$updater = new Light_Bold_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://ttfb.io', // Site where EDD is hosted
		'item_name'      => 'Light & Bold', // Name of theme
		'theme_slug'     => 'light-bold', // Theme slug
		'version'        => LIGHT_BOLD_SL_THEME_VERSION, // The current version of this theme
		'light-bold'         => 'TTFB', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
        'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Getting Started', 'light-bold' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'light-bold' ),
		'license-key'               => __( 'Enter your license key', 'light-bold' ),
		'license-action'            => __( 'License Action', 'light-bold' ),
		'deactivate-license'        => __( 'Deactivate License', 'light-bold' ),
		'activate-license'          => __( 'Activate License', 'light-bold' ),
		'save-license'              => __( 'Save License', 'light-bold' ),
		'status-unknown'            => __( 'License status is unknown.', 'light-bold' ),
		'renew'                     => __( 'Renew?', 'light-bold' ),
		'unlimited'                 => __( 'unlimited', 'light-bold' ),
		'license-key-is-active'     => __( 'Theme updates have been enabled. You will receive a notice on your Themes page when a theme update is available.', 'light-bold' ),
		'expires%s'                 => __( 'Your license for Author expires %s.', 'light-bold' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'light-bold' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'light-bold' ),
		'license-key-expired'       => __( 'License key has expired.', 'light-bold' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'light-bold' ),
		'license-is-inactive'       => __( 'License is inactive.', 'light-bold' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'light-bold' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'light-bold' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'light-bold' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'light-bold' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'light-bold' )
	)

);