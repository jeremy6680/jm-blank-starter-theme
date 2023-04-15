<?php
/**
 * The JM_Theme_Setup class sets up various theme features and functionality.
 */
class JM_Theme_Setup {

    /**
     * Constructor function that adds various actions and filters.
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_menus' ) );
        add_action( 'after_setup_theme', array( $this, 'setup' ) );
        add_filter( 'wp_title', array( $this, 'custom_title' ), 9999 );
        add_action( 'wp_footer', array( $this, 'deregister_scripts' ) );
        add_action( 'upload_mimes', array( $this, 'add_file_types_to_uploads' ), 1, 1 );
        add_filter( 'intermediate_image_sizes_advanced', array( $this, 'remove_default_image_sizes' ) );
        add_filter( 'big_image_size_threshold', '__return_false' );
        add_filter( 'auto_plugin_update_send_email', '__return_false' );
        add_filter( 'auto_theme_update_send_email', '__return_false' );
        $this->remove_wp_emoji();
    }

    /**
     * Registers the main and footer menus.
     */
    public function register_menus() {
        register_nav_menus(
            array(
                'menu-main' => __( 'Main Menu' ),
                'menu-footer' => __( 'Footer Menu' ),
            )
        );
    }

    /**
     * Sets up various theme support features.
     */
    public function setup() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
        load_theme_textdomain( 'jm-theme', get_template_directory() . '/languages' );
        add_theme_support( 'html5', array( 'script', 'style' ) );
        remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
        remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
        remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
        remove_filter( 'render_block', 'wp_render_duotone_support' );
        remove_filter( 'render_block', 'wp_restore_group_inner_container' );
        remove_filter( 'render_block', 'wp_render_layout_support_flag' );
        remove_image_size( '1536x1536' );
        remove_image_size( '2048x2048' );
    }

    /**
     * Sets up a default title on every page
     */
    public function custom_title( $title ) {
        if ( is_front_page() ) {
            $title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
        } else {
            $title = get_the_title() . ' | ' . get_bloginfo( 'name' );
        }
        return $title;
    }

    /**
     * Removes default image sizes.
     *
     * @param array $sizes The array of image sizes.
     * @return array The updated array of image sizes.
     */
    public function remove_default_image_sizes( $sizes ) {
        unset( $sizes['large'] );
        unset( $sizes['medium'] );
        unset( $sizes['medium_large'] );
        return $sizes;
    }

    /**
     * Removes WP emoji scripts and styles.
     */
    public function remove_wp_emoji() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }

    /**
     * Deregisters the WP embed script.
     */
    public function deregister_scripts() {
        wp_deregister_script( 'wp-embed' );
    }

    /**
     * Adds SVG file type to allowed upload mime types.
     *
     * @param array $mime_types The array of allowed mime types.
     * @return array The updated array of allowed mime types.
     */
    public function add_file_types_to_uploads( $mime_types ) {
        $mime_types['svg'] = 'image/svg+xml';
        return $mime_types;
    }

}

// Instantiate the JM_Theme_Setup class.
new JM_Theme_Setup();