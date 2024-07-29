<?php

// Paste in function.php
function nk_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'nk_mime_types' );


// If need then paste in wp-config.php 
define('ALLOW_UNFILTERED_UPLOADS', true);