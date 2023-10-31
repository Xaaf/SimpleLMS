<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

require SIMPLELMS_PATH . "inc/base/simplelms-enqueue.php";
require SIMPLELMS_PATH . "inc/base/simplelms-links.php";
require SIMPLELMS_PATH . "inc/base/simplelms-shortcodes.php";
require SIMPLELMS_PATH . "inc/base/customposttypes/simplelms-customposttypes.php";
require SIMPLELMS_PATH . "inc/views/simplelms-admin.php";

/**
 * `SimpleLMSInit` is responsible for making sure the plugin initialises correctly.
 */
final class SimpleLMSInit
{
    /**
     * Keeps the classes of all services in an array. 
     * @return array List of services.
     */
    public static function get_services()
    {
        return [
                // /base
            SimpleLMSEnqueue::class,
            SimpleLMSLinks::class,
            SimpleLMSShortcodes::class,

                // /base/customposttypes
            SimpleLMSCustomPostTypes::class,

                // /views
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

    public static function set_admin_menu_seperators()
    {
        // Our CPTs start at 67
        self::add_admin_menu_separator(66);

        // Add a seperator before we get back to Wordpress settings
        self::add_admin_menu_separator(69);
    }

    static function add_admin_menu_separator($position)
    {
        global $menu;

        if (!empty($menu)) {
            $index = 0;
            foreach ($menu as $offset => $section) {
                if (substr($section[2], 0, 9) == 'separator')
                    $index++;
                if ($offset >= $position) {
                    $menu[$position] = array('', 'read', "separator{$index}", '', 'wp-menu-separator');
                    break;
                }
            }
            ksort($menu);
        }
    }
}