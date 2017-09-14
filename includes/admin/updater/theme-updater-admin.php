<?php
/**
 * Theme updater admin page and functions.
 *
 * @package Author
 */

/**
 * Redirect to Getting Started page on theme activation
 */
function light_bold_redirect_on_activation() {
	global $pagenow;

	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

		wp_redirect( admin_url( "themes.php?page=author-license" ) );

	}
}
add_action( 'admin_init', 'light_bold_redirect_on_activation' );

/**
 * Load Getting Started styles in the admin
 *
 * since 1.0.0
 */
function light_bold_start_load_admin_scripts() {

	// Load styles only on our page
	global $pagenow;
	if( 'themes.php' != $pagenow )
		return;

	/**
	 * Getting Started scripts and styles
	 *
	 * @since 1.0
	 */

	// Getting Started javascript
	wp_enqueue_script( 'author-getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.js', array( 'jquery' ), '1.0.0', true );

	// Getting Started styles
	wp_register_style( 'author-getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.css', false, '1.0.0' );
	wp_enqueue_style( 'author-getting-started' );

	// Thickbox
	add_thickbox();
}
add_action( 'admin_enqueue_scripts', 'light_bold_start_load_admin_scripts' );

class Light_Bold_Theme_Updater_Admin {

	/**
	 * Variables required for the theme updater
	 *
	 * @since 1.0.0
	 * @type string
	 */
	 protected $remote_api_url = null;
	 protected $theme_slug = null;
	 protected $api_slug = null;
	 protected $version = null;
	 protected $author = null;
	 protected $download_id = null;
	 protected $renew_url = null;
	 protected $strings = null;

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array() ) {

		$config = wp_parse_args( $config, array(
			'remote_api_url' => 'https://ttfb.io',
			'theme_slug'     => get_template(),
			'api_slug'       => get_template(),
			'item_name'      => '',
			'license'        => '',
			'version'        => '',
			'light-bold'         => '',
			'download_id'    => '',
			'renew_url'      => ''
		) );

		// Set config arguments
		$this->remote_api_url = $config['remote_api_url'];
		$this->item_name      = $config['item_name'];
		$this->theme_slug     = sanitize_key( $config['theme_slug'] );
		$this->api_slug       = sanitize_key( $config['api_slug'] );
		$this->version        = $config['version'];
		$this->author         = $config['light-bold'];
		$this->download_id    = $config['download_id'];
		$this->renew_url      = $config['renew_url'];

		// Populate version fallback
		if ( '' == $config['version'] ) {
			$theme = wp_get_theme( $this->theme_slug );
			$this->version = $theme->get( 'Version' );
		}

		// Strings passed in from the updater config
		$this->strings = $strings;

		add_action( 'admin_init', array( $this, 'updater' ) );
		add_action( 'admin_init', array( $this, 'register_option' ) );
		add_action( 'admin_init', array( $this, 'license_action' ) );
		add_action( 'admin_menu', array( $this, 'license_menu' ) );
		add_action( 'update_option_' . $this->theme_slug . '_license_key', array( $this, 'activate_license' ), 10, 2 );
		add_filter( 'http_request_args', array( $this, 'disable_wporg_request' ), 5, 2 );

	}

	/**
	 * Creates the updater class.
	 *
	 * since 1.0.0
	 */
	function updater() {

		/* If there is no valid license key status, don't allow updates. */
		if ( get_option( $this->theme_slug . '_license_key_status', false) != 'valid' ) {
			return;
		}

		if ( !class_exists( 'Light_Bold_Theme_Updater' ) ) {
			// Load our custom theme updater
			include( dirname( __FILE__ ) . '/theme-updater-class.php' );
		}

		new Light_Bold_Theme_Updater(
			array(
				'remote_api_url' => $this->remote_api_url,
				'version'        => $this->version,
				'license'        => trim( get_option( $this->theme_slug . '_license_key' ) ),
				'item_name'      => $this->item_name,
				'light-bold'         => $this->author
			),
			$this->strings
		);
	}

	/**
	 * Adds a menu item for the theme license under the appearance menu.
	 *
	 * since 1.0.0
	 */
	function license_menu() {

		$strings = $this->strings;

		add_theme_page(
			$strings['theme-license'],
			$strings['theme-license'],
			'manage_options',
			$this->theme_slug . '-license',
			array( $this, 'license_page' )
		);
	}

	/**
	 * Outputs the markup used on the theme license page.
	 *
	 * since 1.0.0
	 */
	function license_page() {

		$strings = $this->strings;

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$status = get_option( $this->theme_slug . '_license_key_status', false );

		// Checks license status to display under license key
		if ( ! $license ) {
			$message    = $strings['enter-key'];
		} else {
			// For testing messages
			// delete_transient( $this->theme_slug . '_license_message' );

			if ( ! get_transient( $this->theme_slug . '_license_message', false ) ) {
				set_transient( $this->theme_slug . '_license_message', $this->check_license(), ( 60 * 60 * 24 ) );
			}
			$message = get_transient( $this->theme_slug . '_license_message' );
		}

		/**
		 * Retrieve help file and theme update changelog
		 *
		 * since 1.0.0
		 */

		// Theme info
		$theme = wp_get_theme( 'light-bold' );

		// Lowercase theme name for resources links
		$theme_name_lower = get_template();

		// Grab the change log from ttfb.io for display in the Latest Updates tab
		$changelog = wp_remote_get( 'https://ttfb.io/themes/' . $this->api_slug . '/changelog/' );
		if( $changelog && !is_wp_error( $changelog ) && 200 === wp_remote_retrieve_response_code( $changelog ) ) {
			$changelog = $changelog['body'];
		} else {
			$changelog = esc_html__( 'There seems to be a temporary problem retrieving the latest updates for this theme. You can always view the latest updates in your Array Dashboard.', 'light-bold' );
		}


		/**
		 * Create recommended plugin install URLs
		 *
		 * since 1.0.0
		 */

		if( is_multisite() ) {
			$toolkitUrl = network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=array-toolkit&TB_iframe=true&width=640&height=589' );
		} else {
			$toolkitUrl = admin_url( 'plugin-install.php?tab=plugin-information&plugin=array-toolkit&TB_iframe=true&width=640&height=589' );
		}
	?>

			<div class="wrap getting-started">
				<h2 class="notices"></h2>
				<div class="intro-wrap">
					<div class="intro">
						<h3><?php printf( esc_html__( 'Getting started with %1$s', 'light-bold' ), $theme['Name'] ); ?></h3>

						<h4><?php printf( esc_html__( 'You will find everything you need to get started with Light & Bold below.', 'light-bold' ), $theme['Name'] ); ?></h4>
					</div>
				</div>

				<div class="panels">
					<ul class="inline-list">
						<li class="current"><a id="help-tab" href="#"><?php esc_html_e( 'Help Files', 'light-bold' ); ?></a></li>
						<li><a id="updates-tab" href="#"><?php esc_html_e( 'Latest Updates', 'light-bold' ); ?></a></li>
					</ul>

					<div id="panel" class="panel">

						<!-- Help file panel -->
						<div id="help-panel" class="panel-left visible">

							<!-- Grab feed of help file -->
							<?php
								include_once( ABSPATH . WPINC . '/feed.php' );

								$rss = fetch_feed( 'https://ttfb.io/feed/?post_type=knowledgebase&cat-doc=light-bold&withoutcomments=1' );

								if ( ! is_wp_error( $rss ) ) :
								    $maxitems = $rss->get_item_quantity( 0 );
								    $rss_items = $rss->get_items( 0, $maxitems );
								endif;

								if ( ! is_wp_error( $rss ) ) :
									$rss_items_check = array_filter( $rss_items );
								endif;
                                

							?>

							<!-- Output the feed -->

                            <h2>Help Files for Light & Bold</h2>
                            <p>The following articles provides <strong>answers and solutions</strong> to common problems and issues. </p>
                            <p>We recommend reading the articles thoroughly if you are experiencing any difficulty.</p>

                            <hr>

							<?php if ( is_wp_error( $rss ) || empty( $rss_items_check ) ) : ?>
								<p><?php esc_html_e( 'This help file feed seems to be temporarily down. You can always view the help file on TTFB in the meantime.', 'light-bold' ); ?> <a href="https://ttfb.io/doc/" title="View help file"><?php echo $theme['Name']; ?> <?php esc_html_e( 'Help File &rarr;', 'light-bold' ); ?></a></p>
							<?php else : ?>

                                <div class="ttfb_help">
                                    <?php foreach ( $rss_items as $item ) : ?>
                                        <div class="box">
                                            <a target="_blank" href="<?php echo $item->get_link(); ?>">
                                                <span class="icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" width="24" height="24"><g class="nc-icon-wrapper" fill="#444444"><path fill="#444444" d="M14.242,9.758c-0.49-0.49-1.052-0.878-1.659-1.169C12.208,8.966,12,9.468,12,10 c0,0.213,0.04,0.415,0.102,0.608c0.259,0.161,0.505,0.343,0.726,0.564C13.583,11.928,14,12.932,14,14s-0.416,2.073-1.171,2.829 l-3,2.999c-1.512,1.512-4.146,1.512-5.657,0C3.416,19.072,3,18.068,3,17s0.416-2.072,1.171-2.828l2.104-2.104 C6.098,11.401,6,10.709,6,10c0-0.162,0.013-0.323,0.023-0.483C5.934,9.596,5.843,9.673,5.757,9.758l-3,3C1.624,13.891,1,15.397,1,17 s0.624,3.109,1.757,4.242C3.891,22.376,5.397,23,7,23s3.109-0.624,4.243-1.758l3-2.999C15.375,17.109,16,15.603,16,14 S15.375,10.891,14.242,9.758z"></path> <path data-color="color-2" fill="#444444" d="M21.243,2.758C20.109,1.624,18.603,1,17,1s-3.109,0.624-4.243,1.758l-3,2.999 C8.625,6.891,8,8.397,8,10s0.624,3.109,1.757,4.242c0.49,0.49,1.052,0.878,1.659,1.169C11.792,15.034,12,14.532,12,14 c0-0.218-0.041-0.425-0.106-0.622c-0.258-0.155-0.503-0.332-0.721-0.55C10.417,12.072,10,11.068,10,10s0.416-2.073,1.171-2.829 l3-2.999C14.927,3.416,15.932,3,17,3s2.073,0.416,2.829,1.172C20.584,4.928,21,5.932,21,7s-0.416,2.072-1.171,2.828l-2.107,2.107 C17.9,12.601,18,13.292,18,14c0,0.162-0.012,0.322-0.021,0.482c0.089-0.079,0.18-0.155,0.265-0.24l3-3C22.376,10.109,23,8.603,23,7 S22.376,3.891,21.243,2.758z"></path></g></svg></span>
                                                <span><?php echo $item->get_title(); ?></span>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
							<?php endif; ?>

						</div>

						<!-- Updates panel -->
						<div id="updates-panel" class="panel-left">
							<p><?php echo $changelog; ?></p>
						</div><!-- .panel-left updates -->

						<div class="panel-right">

                            <!-- Activate license -->
							<div class="panel-aside">
								<?php if ( 'valid' == $status ) { ?>

								<h4><?php esc_html_e( 'Sweet, your license is active!', 'light-bold' ); ?></h4>

								<p><?php esc_html_e( 'You will receive a notice on your Themes page when a theme update is available.', 'light-bold' ); ?></p>

								<?php } else { ?>
									<h3 class="">
                                        <span class=""><?php esc_html_e( 'Activate your license to enable theme updates!', 'light-bold' ); ?></span>
                                        
                                    </h3>

								<p>
									<?php esc_html_e( 'With an active license, you can get seamless, one-click theme updates to keep your site healthy and happy. ', 'light-bold' );

										$license_link = 'https://ttfb.io/dashboard';
										printf( __( 'Find your license key in your <a target="_blank" href="%s">TTFB Dashboard</a>.', 'light-bold' ), esc_url( $license_link ) );
									?>
								</p>
								<?php } ?>

								<!-- License setting -->
								<form class="enter-license" method="post" action="options.php">
									<?php settings_fields( $this->theme_slug . '-license' ); ?>

									<input id="<?php echo $this->theme_slug; ?>_license_key" name="<?php echo $this->theme_slug; ?>_license_key" type="text" class="regular-text license-key-input" value="<?php echo esc_attr( $license ); ?>" placeholder="<?php echo $strings['license-key']; ?>"/>

									<!-- If we have a license -->
									<?php
										wp_nonce_field( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' );
										if ( 'valid' == $status ) { ?>
											<input type="submit" class="button-primary" name="<?php echo $this->theme_slug; ?>_license_deactivate" value="<?php esc_attr_e( $strings['deactivate-license'] ); ?>"/>
										<?php } else { ?>
											<small style="font-size:12px;"><?php esc_html_e( 'Be sure to activate your license after saving it.', 'light-bold' ); ?></small><br/><br/>
											<?php if ( $license ) { ?>
												<input type="submit" class="button-primary club-button" name="<?php echo $this->theme_slug; ?>_license_activate" value="<?php esc_attr_e( $strings['activate-license'] ); ?>"/>
											<?php } else { ?>
												<input type="submit" class="button-primary club-button" name="<?php echo $this->theme_slug; ?>_license_activate" value="<?php esc_attr_e( $strings['save-license'] ); ?>"/>
											<?php } ?>
										<?php }
										?>

								</form><!-- .enter-license -->

							</div><!-- .panel-aside license -->


							<div class="panel-aside panel-club">
								
								<div class="panel-club-inside">
									<h3><?php esc_html_e( 'Page Speed Tips', 'light-bold' ); ?></h3>

                                    <p><strong>Fast WordPress Hosting</strong></p>
									<p><?php esc_html_e( 'TTFB is hosted on Siteground with the GOGEEK plan. Siteground is a cheap WordPress hosting with FREE SSDs, FREE SSL, HTTP/2, PHP7, Domain, and Backups.', 'light-bold' ); ?></p>

									<a class="" href="https://www.siteground.com/go/speed-wordpress" target="_blank"><?php esc_html_e( 'Fast WordPress Hosting', 'light-bold' ); ?> &rarr;</a>

                                    <hr>

                                    <p><strong>WordPress Caching Plugins</strong></p>
									<p><?php esc_html_e( 'TTFB trust Cache Enabler has WordPress caching plugin. It requires minimal setup time and allows you to quickly activate caching. Most of all, the plugin is free!', 'light-bold' ); ?></p>

									<a class="" target="_blank" href="https://wordpress.org/plugins/cache-enabler/"><?php esc_html_e( 'Get Cache Enabler', 'light-bold' ); ?> &rarr;</a>

                                    <hr>
                                    <p><strong>CDN and Security</strong></p>
									<p><?php esc_html_e( 'TTFB is accelerated by Cloudflare. Performance is not just about moving static files closer to visitors, it is also about ensuring that every page renders as fast and efficiently as possible from whatever device a visitor is surfing from. Cloudflare users can choose any combination of these Internet property content optimization features that take performance to the next level.', 'light-bold' ); ?></p>

									<a class="" target="_blank" href="https://www.cloudflare.com/"><?php esc_html_e( 'Activate Cloudflare', 'light-bold' ); ?> &rarr;</a>
								</div>
							</div>

							
						</div><!-- .panel-right -->
					</div><!-- .panel -->
				</div><!-- .panels -->
			</div><!-- .getting-started -->

		<?php
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 *
	 * since 1.0.0
	 */
	function register_option() {
		register_setting(
			$this->theme_slug . '-license',
			$this->theme_slug . '_license_key',
			array( $this, 'sanitize_license' )
		);
	}

	/**
	 * Sanitizes the license key.
	 *
	 * since 1.0.0
	 *
	 * @param string $new License key that was submitted.
	 * @return string $new Sanitized license key.
	 */
	function sanitize_license( $new ) {

		$old = get_option( $this->theme_slug . '_license_key' );

		if ( $old && $old != $new ) {
			// New license has been entered, so must reactivate
			delete_option( $this->theme_slug . '_license_key_status' );
			delete_transient( $this->theme_slug . '_license_message' );
		}

		return $new;
	}

	/**
	 * Makes a call to the API.
	 *
	 * @since 1.0.0
	 *
	 * @param array $api_params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	 function get_api_response( $api_params ) {

		 // Call the custom API.
		$response = wp_remote_get(
			esc_url_raw( add_query_arg( $api_params, $this->remote_api_url ) ),
			array( 'timeout' => 15, 'sslverify' => false )
		);

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			return false;
		}

		$response = json_decode( wp_remote_retrieve_body( $response ) );

		return $response;
	 }

	/**
	 * Activates the license key.
	 *
	 * @since 1.0.0
	 */
	function activate_license() {

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name )
		);

		$license_data = $this->get_api_response( $api_params );

		// $response->license will be either "active" or "inactive"
		if ( $license_data && isset( $license_data->license ) ) {
			update_option( $this->theme_slug . '_license_key_status', $license_data->license );
			delete_transient( $this->theme_slug . '_license_message' );

			// Set the Typekit kit ID
			if( 'invalid' != $license_data->license ) {

				// If the Typekit kit ID is missing from the license response, fetch it by other means.
				if( isset( $license_data->typekit_id ) && empty( $license_data->typekit_id ) || ! isset( $license_data->typekit_id ) ) {

					$response = wp_remote_get( 'https://ttfb.io/themes/'. $this->api_slug .'/array_json_api/typekit_api/?get-typekit-id='. $license );

					$typekit_id = json_decode( wp_remote_retrieve_body( $response ) );

					if( $typekit_id && ! empty( $typekit_id ) ) {
						update_option( 'array_typekit_id', $typekit_id );
					}

				} else {
					update_option( 'array_typekit_id', $license_data->typekit_id );
				}
			}
		}
	}

	/**
	 * Deactivates the license key.
	 *
	 * @since 1.0.0
	 */
	function deactivate_license() {

		// Retrieve the license from the database.
		$license = trim( get_option( $this->theme_slug . '_license_key' ) );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name )
		);

		$license_data = $this->get_api_response( $api_params );

		// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data && ( $license_data->license == 'deactivated' ) ) {
			// Delete license key status
			delete_option( $this->theme_slug . '_license_key_status' );
			// Delete the Typekit ID
			delete_option( 'array_typekit_id' );
			delete_transient( $this->theme_slug . '_license_message' );
		}
	}

	/**
	 * Constructs a renewal link
	 *
	 * @since 1.0.0
	 */
	function get_renewal_link() {

		// If a renewal link was passed in the config, use that
		if ( '' != $this->renew_url ) {
			return $this->renew_url;
		}

		// If download_id was passed in the config, a renewal link can be constructed
		$license_key = trim( get_option( $this->theme_slug . '_license_key', false ) );
		if ( '' != $this->download_id && $license_key ) {
			$url = esc_url( $this->remote_api_url );
			$url .= '/light-bold/?edd_license_key=' . $license_key . '&download_id=' . $this->download_id;
			return $url;
		}

		// Otherwise return the remote_api_url
		return $this->remote_api_url;

	}



	/**
	 * Checks if a license action was submitted.
	 *
	 * @since 1.0.0
	 */
	function license_action() {

		if ( isset( $_POST[ $this->theme_slug . '_license_activate' ] ) ) {
			if ( check_admin_referer( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' ) ) {
				$this->activate_license();
			}
		}

		if ( isset( $_POST[$this->theme_slug . '_license_deactivate'] ) ) {
			if ( check_admin_referer( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' ) ) {
				$this->deactivate_license();
			}
		}

	}

	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @since 1.0.0
	 *
	 * @return string $message License status message.
	 */
	function check_license() {

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$strings = $this->strings;

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name )
		);

		$license_data = $this->get_api_response( $api_params );

		// If response doesn't include license data, return
		if ( !isset( $license_data->license ) ) {
			$message = $strings['status-unknown'];
			return $message;
		}

		// Get expire date
		$expires = false;
		if ( isset( $license_data->expires ) ) {
			$expires = date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires ) );
			$renew_link = '<a href="' . esc_url( $this->get_renewal_link() ) . '" target="_blank">' . $strings['renew'] . '</a>';
		}

		// Get site counts
		$site_count = $license_data->site_count;
		$license_limit = $license_data->license_limit;

		// If unlimited
		if ( 0 == $license_limit ) {
			$license_limit = $strings['unlimited'];
		}

		if ( $license_data->license == 'valid' ) {
			$message = $strings['license-key-is-active'] . ' ';
			if ( $expires ) {
				$message .= sprintf( $strings['expires%s'], $expires ) . ' ';
			}
			if ( $site_count && $license_limit ) {
				//$message .= sprintf( $strings['%1$s/%2$-sites'], $site_count, $license_limit );
			}
		} else if ( $license_data->license == 'expired' ) {
			if ( $expires ) {
				$message = sprintf( $strings['license-key-expired-%s'], $expires );
			} else {
				$message = $strings['license-key-expired'];
			}
			if ( $renew_link ) {
				$message .= ' ' . $renew_link;
			}
		} else if ( $license_data->license == 'invalid' ) {
			$message = $strings['license-keys-do-not-match'];
		} else if ( $license_data->license == 'inactive' ) {
			$message = $strings['license-is-inactive'];
		} else if ( $license_data->license == 'disabled' ) {
			$message = $strings['license-key-is-disabled'];
		} else if ( $license_data->license == 'site_inactive' ) {
			// Site is inactive
			$message = $strings['site-is-inactive'];
		} else {
			$message = $strings['license-status-unknown'];
		}

		return $message;
	}

	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @since 1.0.0
	 */
	function disable_wporg_request( $r, $url ) {

		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
 			return $r;
 		}

 		// Decode the JSON response
 		$themes = json_decode( $r['body']['themes'] );

 		// Remove the active parent and child themes from the check
 		$parent = get_option( 'template' );
 		$child = get_option( 'stylesheet' );
 		unset( $themes->themes->$parent );
 		unset( $themes->themes->$child );

 		// Encode the updated JSON response
 		$r['body']['themes'] = json_encode( $themes );

 		return $r;
	}

}
