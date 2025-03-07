<?php

defined( 'WP_UNINSTALL_PLUGIN' ) || die( 'Cheatin&#8217; uh?' );

// Drop the data.
global $wpdb;

$wpdb->query( 'DELETE FROM ' .  $wpdb->postmeta . ' WHERE meta_key = "_rt_contributors" ' );
