<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

/**
 * `SimpleLMSLinks` holds all methods related to the links seen in the `Plugins` tab on WordPress.
 */
class SimpleLMSLinks
{
    public function register()
    {
        add_filter("plugin_action_links_" . SIMPLELMS_NAME, array($this, "settings_link"));
    }

    public function settings_link($links)
    {
        array_push($links, '<a href="admin.php?page=simplelms">Settings</a>');
        return $links;
    }
}