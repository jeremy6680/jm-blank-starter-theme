<?php
/**
 * The JM_Admin_Options class is responsible for registering the main options metabox and its child metaboxes.
 */
class JM_Admin_Options {

    /**
     * Constructor function that adds an action to register the main options metabox.
     */
    public function __construct() {
        add_action( 'cmb2_admin_init', array( $this, 'register_main_options_metabox' ) );
    }

    /**
     * Function to register the main options metabox and its child metaboxes.
     *
     * @return void
     */
    public function register_main_options_metabox() {
        $main_options = new_cmb2_box( array(
            'id'           => 'jm_main_options_page',
            'title'        => esc_html__( 'Main Options', 'cmb2' ),
            'object_types' => array( 'options-page' ),
            'option_key'   => 'jm_main_options',
			// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
			// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
			// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
			// 'capability'      => 'manage_options', // Cap required to view options-page.
			'position'        => 2, // Menu position. Only applicable if 'parent_slug' is left empty.
			// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
			// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
			// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
			// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
			// 'message_cb'      => 'jm_options_page_message_callback',
        ) );
        
        $this->add_site_background_color_field( $main_options );
        $this->register_secondary_options_metabox( $main_options );
        $this->register_tertiary_options_metabox( $main_options );
        $this->register_cta_options_metabox( $main_options );
        $this->register_footer_options_metabox( $main_options );
		$this->register_contact_details_metabox( $main_options );
    }

    /**
     * Function to add the site background color field to the main options metabox.
     *
     * @param object $main_options The main options metabox object.
     * @return void
     */
    private function add_site_background_color_field( $main_options ) {
        $main_options->add_field( array(
            'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
            'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'      => 'bg_color',
            'type'    => 'colorpicker',
            'default' => '#ffffff',
        ) );
    }

    /**
     * Function to register the secondary options metabox and its fields.
     *
     * @param object $main_options The main options metabox object.
     * @return void
     */
    private function register_secondary_options_metabox( $main_options ) {
        $secondary_options = new_cmb2_box( array(
            'id'           => 'jm_secondary_options_page',
            'title'        => esc_html__( 'Social Networks', 'cmb2' ),
            'object_types' => array( 'options-page' ),
            'option_key'   => 'jm_secondary_options',
            'parent_slug'  => 'jm_main_options',
        ) );

        $secondary_options->add_field( array(
            'name' => esc_html__( 'Social Networks', 'cmb2' ),
            'id'   => 'social_networks',
            'type' => 'group',
            'options'     => array(
                'group_title'   => esc_html__( 'Social Network {#}', 'cmb2' ), // {#} will be replaced by row number
                'add_button'    => esc_html__( 'Add Another Social Network', 'cmb2' ),
                'remove_button' => esc_html__( 'Remove Social Network', 'cmb2' ),
                'sortable'      => true,
            ),
            'fields'      => array(
                array(
                    'name' => esc_html__( 'Social Network Name', 'cmb2' ),
                    'id'   => 'name',
                    'type' => 'text_small',
                ),
                array(
                    'name' => esc_html__( 'Social Network URL', 'cmb2' ),
                    'id'   => 'url',
                    'type' => 'text_url',
                ),
            ),
        ) );
    }

    /**
     * Function to register the tertiary options metabox and its fields.
     *
     * @param object $main_options The main options metabox object.
     * @return void
     */
    private function register_tertiary_options_metabox( $main_options ) {
        $tertiary_options = new_cmb2_box( array(
            'id'           => 'jm_tertiary_options_page',
            'title'        => esc_html__( 'Snippets', 'cmb2' ),
            'object_types' => array( 'options-page' ),
            'option_key'   => 'jm_tertiary_options',
            'parent_slug'  => 'jm_main_options',
        ) );

		$tertiary_options->add_field( array(
			'name' => esc_html__( 'Test Text Area for Code', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'textarea_code',
			'type' => 'textarea_code',
		) );

	}

	/**
	 * Function to register the CTA options metabox and its fields.
	 *
	 * @param object $main_options The main options metabox object.
	 * @return void
	 */
	private function register_cta_options_metabox( $main_options ) {
		$cta_options = new_cmb2_box( array(
			'id'           => 'jm_cta_options_page',
			'title'        => esc_html__( 'CTA Options', 'cmb2' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'jm_cta_options',
			'parent_slug'  => 'jm_main_options',
		) );

		$cta_options->add_field( array(
			'name' => esc_html__( 'CTA Title', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_cta_title',
			'type' => 'text',
		) );
	
		$cta_options->add_field( array(
			'name' => esc_html__( 'CTA Subtitle', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_cta_subtitle',
			'type' => 'wysiwyg',
		) );
	
		$cta_options->add_field( array(
			'name' => esc_html__( 'CTA Button Title', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_cta_button_title',
			'type' => 'text',
		) );

	}

	/**
	 * Function to register the footer options metabox and its fields.
	 *
	 * @param object $main_options The main options metabox object.
	 * @return void
	 */
	private function register_footer_options_metabox( $main_options ) {
		$footer_options = new_cmb2_box( array(
			'id'           => 'jm_footer_options_page',
			'title'        => esc_html__( 'Footer Options', 'cmb2' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'jm_footer_options',
			'parent_slug'  => 'jm_main_options',
		) );
	
		$footer_options->add_field( array(
			'name' => esc_html__( 'Footer CTA Title', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_footer_cta_title',
			'type' => 'text',
		) );
	
		$footer_options->add_field( array(
			'name' => esc_html__( 'Footer CTA Subtitle', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_footer_cta_subtitle',
			'type' => 'wysiwyg',
		) );
	
		$footer_options->add_field( array(
			'name' => esc_html__( 'Footer CTA Button Title', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_footer_cta_button_title',
			'type' => 'text',
		) );
	
		$footer_options->add_field( array(
			'name' => esc_html__( 'Footer CTA Button Link', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_footer_cta_button_link',
			'type' => 'text_url',
		) );
	}

	/**
	 * Function to register the Contact Details metabox for the main options page.
	 *
	 * @param array $main_options The main options page array.
	 * @return void
	 */
	private function register_contact_details_metabox( $main_options ) {
		// Create a new CMB2 box for the Contact Details section.
		$contact_details = new_cmb2_box( array(
			'id'           => 'jm_contact_details_page',
			'title'        => esc_html__( 'Contact Details', 'cmb2' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'jm_contact_details',
			'parent_slug'  => 'jm_main_options',
		) );

		// Add a field for the email address.
		$contact_details->add_field( array(
			'name' => esc_html__( 'Email address', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'jm_email_address',
			'type' => 'text',
		) );
	}

}

new JM_Admin_Options();