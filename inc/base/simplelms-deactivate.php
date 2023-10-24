<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

class SimpleLMSDeactivate
{
    /**
     * Exit point for the SimpleLMS plugin. This method is called when the user deactivates this plugin.
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}