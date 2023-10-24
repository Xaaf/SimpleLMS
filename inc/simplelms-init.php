<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

require PLUGIN_PATH . "inc/base/simplelms-enqueue.php";
require PLUGIN_PATH . "inc/base/simplelms-links.php";
require PLUGIN_PATH . "inc/views/simplelms-admin.php";

/**
 * `SimpleLMSInit` is responsible for making sure the plugin initialises correctly.
 */
final class SimpleLMSInit
{
    /**
     * Keeps the classes of all services in an array. 
     * @return array List of services
     */
    public static function get_services()
    {
        return [
            // /base
            SimpleLMSEnqueue::class,
            SimpleLMSLinks::class,

            // views
            Views\SimpleLMSAdmin::class,
        ];
    }

    /**
     * Register each class as a service. Calls the `register()` method
     * if it exists for that service.
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);

            if (method_exists($service, "register")) {
                $service->register();
            }
        }
    }

    /**
     * Instantiate a new instance of the given class.
     * @param  object $class `Class` from to instantiate.
     * @return object New instance of the given class.
     */
    private static function instantiate($class)
    {
        return new $class();
    }
}