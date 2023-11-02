<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS;

/**
 * Responsible for handling tasks on plugin activation
 */
class Activation
{
    /**
     * Runs on activation of the plugin.
     */
    public static function activate()
    {
        flush_rewrite_rules();
    }
}
