<?php

// Utilities functions here
function jm_image_path( $image ) {
    if ( 'local' === wp_get_environment_type() ) {
      echo esc_url( $image );
    } else {
      echo 'YOUR_TWICPICS_URL' . esc_url( $image );
    }
  }