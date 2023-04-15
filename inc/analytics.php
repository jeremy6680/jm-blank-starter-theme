<?php
/**
 * The JM_Analytics class adds tracking scripts to the WordPress site.
 */
class JM_Analytics {
    
    /**
     * Constructor function that adds the add_tracking_scripts function to the wp_head action.
     */
    public function __construct() {
        add_action( 'wp_head', array( $this, 'add_tracking_scripts' ) );
    }

    /**
     * Function that calls the private functions to add the tracking scripts.
     */
    public function add_tracking_scripts() {
        $this->add_matomo_tracking_script();
    }

    /**
     * Private function that adds the Matomo tracking script to the site.
     */
    private function add_matomo_tracking_script() {
        ?>
        <!-- Matomo -->
        <script>
            var _paq = window._paq = window._paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(["disableCookies"]);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="YOUR_MATOMO_URL";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', 'YOUR_SITE_ID']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <!-- End Matomo Code -->
        <?php
    }
    
}

// Instantiate the JM_Analytics class.
new JM_Analytics();