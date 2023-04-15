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
		// Enqueue main script in the footer
		wp_enqueue_script( 'jm-theme', get_template_directory_uri() . '/assets/dist/js/main.js', null, null, true );
	}
	
	/**
	 * Function to add stylesheets for the theme.
	 * Removes default stylesheet enqueues and adds custom stylesheet enqueues.
	 */
	public function add_stylesheets() {
		wp_enqueue_style( 'jm-theme', get_template_directory_uri() . '/assets/dist/css/main.css', null, null, 'all' );
	}
	
}

// Instantiate the class
$jm_theme_enqueues = new JM_Theme_Enqueues();