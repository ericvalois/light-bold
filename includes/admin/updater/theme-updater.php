<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'Lightbold_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// The theme version to use in the updater
define( 'Lightbold_SL_THEME_VERSION', wp_get_theme( 'lightbold' )->get( 'Version' ) );

// Loads the updater classes
$updater = new Lightbold_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://perfthemes.com', // Site where EDD is hosted
		'item_name'      => 'Light & Bold WordPress Theme', // Name of theme
		'theme_slug'     => 'lightbold', // Theme slug
		'version'        => Lightbold_SL_THEME_VERSION, // The current version of this theme
		'lightbold'         => 'Perfthemes', // The author of this theme
		'download_id'    => '1995', // Optional, used for generating a license renewal link
		'renew_url'      => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Getting Started', 'lightbold' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'lightbold' ),
		'license-key'               => __( 'Enter your license key', 'lightbold' ),
		'license-action'            => __( 'License Action', 'lightbold' ),
		'deactivate-license'        => __( 'Deactivate License', 'lightbold' ),
		'activate-license'          => __( 'Activate License', 'lightbold' ),
		'save-license'              => __( 'Save License', 'lightbold' ),
		'status-unknown'            => __( 'License status is unknown.', 'lightbold' ),
		'renew'                     => __( 'Renew?', 'lightbold' ),
		'unlimited'                 => __( 'unlimited', 'lightbold' ),
		'license-key-is-active'     => __( 'Theme updates have been enabled. You will receive a notice on your Themes page when a theme update is available.', 'lightbold' ),
		'expires%s'                 => __( 'Your license for Light & Bold expires %s.', 'lightbold' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'lightbold' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'lightbold' ),
		'license-key-expired'       => __( 'License key has expired.', 'lightbold' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'lightbold' ),
		'license-is-inactive'       => __( 'License is inactive.', 'lightbold' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'lightbold' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'lightbold' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'lightbold' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'lightbold' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'lightbold' )
	)

);