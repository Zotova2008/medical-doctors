<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MD_THEME_VERSION', '1.0.0' );
define( 'MD_THEME_DIR', get_template_directory() );
define( 'MD_THEME_URI', get_template_directory_uri() );

require_once MD_THEME_DIR . '/includes/cpt-doctors.php';
require_once MD_THEME_DIR . '/includes/taxonomies.php';
require_once MD_THEME_DIR . '/includes/meta-boxes.php';
require_once MD_THEME_DIR . '/includes/filters.php';
require_once MD_THEME_DIR . '/includes/helper-functions.php';

function md_enqueue_assets() {
	wp_enqueue_style( 'md-style', get_stylesheet_uri(), [], MD_THEME_VERSION );
	wp_enqueue_style( 'md-doctors-style', MD_THEME_URI . '/assets/css/doctors-style.css', [], MD_THEME_VERSION );
	wp_enqueue_script( 'md-doctors-filters', MD_THEME_URI . '/assets/js/doctors-filters.js', [ 'jquery' ], MD_THEME_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'md_enqueue_assets' );

function md_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	register_nav_menus( [ 'primary' => __( 'Primary Menu', 'medical-doctors' ) ] );

	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
}

add_action( 'after_setup_theme', 'md_theme_setup' );