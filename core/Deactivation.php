<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS;

/**
 * Responsible for handling tasks on plugin deactivation
 */
class Deactivation
{
    /**
     * Runs on deactivation of the plugin.
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
