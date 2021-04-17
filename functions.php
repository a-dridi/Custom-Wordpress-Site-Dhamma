<?php

/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once $understrap_inc_dir . $file;
}


/**
 * Load website logo settings
 */
function blueauthentic_custom_logo_setup() {
	$defaults = array(
		'height'               => 150,
		'width'                => 450,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true,
	);
	add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'blueauthentic_custom_logo_setup' );


function ba_my_car_post_type() {
	$options = array(
		'labels'       => array(
			'name'          => 'Autos',
			'singular_name' => 'Auto',
		),
		'menu_icon'    => 'dashicon-images-alt2',
		'hierarchical' => true,
		'public'       => true,
		'has_archive'  => true,
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'meine-autos' ),
	);

	register_post_type( 'autos', $options );
}

add_action( 'init', 'ba_my_car_post_type' );


function my_custom_taxonomy_1() {

	$options = array(
		'labels'       => array(
			'name'          => 'Marken',
			'singular_name' => 'Marke',
		),
		'public'       => true,
		'hierarchical' => false, // false => tag, true => wie kategorie
	);

	register_taxonomy( 'marken', array( 'autos' ), $options );

}
add_action( 'init', 'my_custom_taxonomy_1' );

/**
 * Load theme settings page
 */
function blueauthentic_theme_settings_page() {  ?>
	<div class="wrap">
		<h1>Theme Settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'theme-options-group-social' );
			do_settings_sections( 'theme-options-section-social' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

function blueauthentic_social_section_description() {
	echo '<p>Add all URLs/links of your social media accounts, that should be displayed in the header section of the website.</p>';
}


function blueauthentic_add_theme_menu_item() {
	add_theme_page( 'Theme Customization', 'Theme Customization', 'manage_options', 'theme-options-section-social', 'blueauthentic_theme_settings_page', null, 99 );
}
add_action( 'admin_menu', 'blueauthentic_add_theme_menu_item' );


/**
 * Load all setting fields of the setting section "social
 */

function social_facebook_option_callback() {
	$facebook_option_value = get_option( 'social_facebook_option' );
	if ( ! empty( $facebook_option_value ) ) {
		echo '<input name="social_facebook_option" id="social_facebook_option" type="text" value="' . $facebook_option_value . '" class="code" />';
	} else {
		echo '<input name="social_facebook_option" id="social_facebook_option" type="text" value="" class="code"/> ';
	}
}

function social_twitter_option_callback() {
	 $twitter_option_value = get_option( 'social_twitter_option' );
	if ( ! empty( $facebook_option_value ) ) {
		echo '<input name="social_twitter_option" id="social_twitter_option" type="text" value="' . $twitter_option_value . '" class="code" />';
	} else {
		echo '<input name="social_twitter_option" id="social_twitter_option" type="text" value="" class="code"/> ';
	}
}

function social_youtube_option_callback() {
	 $youtube_option_value = get_option( 'social_youtube_option' );
	if ( ! empty( $facebook_option_value ) ) {
		echo '<input name="social_youtube_option" id="social_youtube_option" type="text" value="' . $youtube_option_value . '" class="code" />';
	} else {
		echo '<input name="social_youtube_option" id="social_youtube_option" type="text" value="" class="code"/> ';
	}
}


/**
 * Add all settings sections and their settings options to the settings page
 */
function blueauthentic_theme_settings() {
	add_settings_section(
		'social_section',
		'Social Media Account Links/URLs',
		'blueauthentic_social_section_description',
		'theme-options-section-social'
	);

	add_option( 'social_facebook_option', 1 );
	add_settings_field(
		'social_facebook_option',
		'Facebook Account',
		'social_facebook_option_callback',
		'theme-options-section-social',
		'social_section'
	);
	register_setting( 'theme-options-group-social', 'social_facebook_option' );

	add_option( 'social_twitter_option', 2 );
	add_settings_field(
		'social_twitter_option',
		'Twitter Account',
		'social_twitter_option_callback',
		'theme-options-section-social',
		'social_section'
	);
	register_setting( 'theme-options-group-social', 'social_twitter_option' );

	add_option( 'social_youtube_option', 3 );
	add_settings_field(
		'social_youtube_option',
		'Youtube Account',
		'social_youtube_option_callback',
		'theme-options-section-social',
		'social_section'
	);
	register_setting( 'theme-options-group-social', 'social_youtube_option' );
}
add_action( 'admin_init', 'blueauthentic_theme_settings' );

/**
 * Custom Theme Customization START
 */
function dhamma_header_right_widget_init() {
	register_sidebar(
		array(
			'name'          => 'Header Right Widget',
			'id'            => 'header-right-widget',
			'before_widget' => '<div class="header-right-widget-area">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="header-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dhamma_header_right_widget_init' );

function dhamma_header_middle_widget_init() {
	register_sidebar(
		array(
			'name'          => 'Header Middle Widget',
			'id'            => 'header-middle-widget',
			'before_widget' => '<div class="header-middle-widget-area">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="header-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dhamma_header_middle_widget_init' );

function dhamma_header_left_widget_init() {
	register_sidebar(
		array(
			'name'          => 'Header Left Widget',
			'id'            => 'header-left-widget',
			'before_widget' => '<div class="header-left-widget-area">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="header-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dhamma_header_left_widget_init' );


/**
 * Settings after denying cookie button. Add the code to hide the tracking scripts in the "if" statement or in the file "/js/cookies_denied.js".
 */
function eu_cookie_button_settings() {
	if ( cn_cookies_set() && cn_cookies_accepted() === false ) {
		wp_enqueue_script( 'script', get_template_directory_uri() . '/js/cookies_denied.js', array( 'jquery' ), 1.2, true );
	}
}
add_action( 'init', 'eu_cookie_button_settings' );


/**
 * Custom Theme Customization END
 */
