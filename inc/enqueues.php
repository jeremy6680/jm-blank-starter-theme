<?php
/**
 * Class JM_Theme_Enqueues
 *
 * This class is responsible for enqueuing scripts and stylesheets for the theme.
 */
class JM_Theme_Enqueues {
	
	/**
	 * Constructor function that adds actions to enqueue scripts and stylesheets.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_stylesheets' ) );
	}
	
	/**
	 * Function to enqueue scripts for the theme.
	 * Removes default script enqueues and adds custom script enqueues.
	 */
	public function enqueue_scripts() {
		// force all scripts to load in footer
		remove_action( 'wp_head', 'wp_print_scripts' );
		remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
		remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
		// Enqueue Modernizr in the head section
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/vendors/modernizr.js', array(), '3.6.0', false );
		// Enqueue plugins.js in the footer
		wp_enqueue_script( 'plugins', get_template_directory_uri() . '/assets/vendors/plugins.js', array( 'jquery' ), '1.0.0', true );
		// Enqueue main script in the footer
		wp_enqueue_script( 'jm-theme', get_template_directory_uri() . '/assets/dist/js/main.js', null, null, true );
	}
	
	/**
	 * Function to add stylesheets for the theme.
	 * Removes default stylesheet enqueues and adds custom stylesheet enqueues.
	 */
	public function add_stylesheets() {
		// removing all WP css files enqueued by default
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );

		wp_enqueue_style( 'jm-theme', get_template_directory_uri() . '/assets/dist/css/main.css', null, null, 'all' );
	}
	
}

// Instantiate the class
$jm_theme_enqueues = new JM_Theme_Enqueues();