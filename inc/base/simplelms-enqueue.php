<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

class SimpleLMSEnqueue
{
    public function register()
    {
        add_action("admin_enqueue_scripts", array($this, "admin_enqueue"));
    }

    /**
     * Enqueue different assets used on the admin-side.
     * @return void
     */
    function admin_enqueue()
    {
        wp_enqueue_style("simplelmsstyle", PLUGIN_URL . "/assets/style.css");
    }
}