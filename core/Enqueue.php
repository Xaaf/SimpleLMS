<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS;

class Enqueue
{
    public function register()
    {
        add_action("wp_enqueue_scripts", [$this, "enqueue"]);
    }

    /**
     * Enqueue the assets required by the plugin.
     */
    function enqueue()
    {
        wp_enqueue_style("simplelms_css", SIMPLELMS_URL . "/assets/css/simplelms.css");
    }
}