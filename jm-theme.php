<?php
/**
 * The JMTheme class is responsible for setting up the theme and including necessary files.
 */
class JM_Theme {

  /**
   * The path to the CMB2 library.
   *
   * @var string
   */
  private $cmb2Path;

  /**
   * Initializes the JMTheme class.
   */
  public function __construct() {
    $this->cmb2Path = get_template_directory() . '/vendor/cmb2/init.php';
    add_action('after_setup_theme', array($this, 'afterSetupTheme'));
  }

  /**
   * Calls the requireCmb2() and includeFiles() methods.
   */
  public function afterSetupTheme() {
    $this->requireCmb2();
    $this->includeFiles();
  }

  /**
   * Requires the CMB2 library if it exists.
   */
  private function requireCmb2() {
    if (file_exists($this->cmb2Path)) {
      require_once $this->cmb2Path;
    }
  }

  /**
   * Includes necessary theme files.
   */
  private function includeFiles() {
    $files = array(
      'inc/setup.php',
      'inc/metaboxes.php',
      'inc/enqueues.php',
      'inc/custom-post-types.php',
      'inc/taxonomies.php',
      'inc/utilities.php',
      'inc/shortcodes.php',
      'inc/analytics.php'
    );
    foreach ($files as $file) {
      $this->includeFile($file);
    }
    if (is_admin()) {
      $this->includeFile('inc/admin.php');
    }
  }

  /**
   * Includes a specific file if it exists.
   *
   * @param string $file The file to include.
   */
  private function includeFile($file) {
    $path = get_template_directory() . '/' . $file;
    if (file_exists($path)) {
      include_once $path;
    }
  }
}

// Initializes the JMTheme class.
new JM_Theme();