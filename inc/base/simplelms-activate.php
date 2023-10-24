<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

/**
 * `SimpleLMSActivate` holds all methods related to plugin activation.
 */
class SimpleLMSActivate
{
    /**
     * Entrypoint for the SimpleLMS plugin. This method is called when the user activates this plugin.
     */
    public static function activate()
    {
        flush_rewrite_rules();
    }
}