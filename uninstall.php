<?php

/**
 * Triggers on Plugin uninstall
 * 
 * @package SimpleLMS
 */

// Don't expose information
if (!function_exists("add_action")) {
    echo "You're not supposed to be here...";
    exit;
}

global $wpdb;

// Clear Database stored data
$wpdb->query("DELETE FROM wp_posts WHERE post_type='course'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
