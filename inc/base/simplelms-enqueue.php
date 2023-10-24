<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

/**
 * `SimpleLMSEnqueue` holds all methods related to enqueueing scripts and assets.
 */
class SimpleLMSEnqueue
{
    public function register()
    {
        add_action("admin_enqueue_scripts", [$this, "admin_enqueue"]);
    }

    /**
     * Enqueue different assets used on the admin-side.
     * @return void
     */
    function admin_enqueue()
    {
        wp_enqueue_style("simplelmsstyle", SIMPLELMS_URL . "/assets/style.css");
    }
}