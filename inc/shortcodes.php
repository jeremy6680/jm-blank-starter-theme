<?php
/**
 * The JM_Shortcodes class defines shortcodes used by the theme.
 */
class JM_Shortcodes {
    /**
     * Constructor function that adds the shortcodes.
     */
    public function __construct() {
        add_shortcode( 'social_networks', array( $this, 'output_social_networks_shortcode' ) );
    }

    /**
     * Generates a shortcode for displaying social network links.
     *
     * @param array $atts An array of shortcode attributes.
     * @return string The HTML output for the social network links.
     */
    public function output_social_networks_shortcode( $atts ) {
        // Parse shortcode attributes with defaults
        $atts = shortcode_atts( array(
            'class' => '',
            'target' => '_blank'
        ), $atts );

        // Retrieve the social networks data from the options page
        $social_networks = get_option( 'jm_secondary_options' )['social_networks'];

        // Output the <ul> element with an optional class
        if ( $social_networks ) {
            $output = '<ul class="' . esc_attr( $atts['class'] ) . '">';
            foreach ( $social_networks as $social_network ) {
                $name = $social_network['name'];
                $url = $social_network['url'];
                $output .= '<li><a href="' . esc_url( $url ) . '" title="' . esc_attr( $name ) . '" target="' . esc_attr( $atts['target'] ) . '">' . esc_html( $name ) . '</a></li>';
            }
            $output .= '</ul><!-- end hero-social -->';
            return $output;
        }
    }
}

// Instantiate the JM_Shortcodes class
new JM_Shortcodes();