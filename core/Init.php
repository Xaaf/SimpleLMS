<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS;

use SimpleLMS\Admin;
use SimpleLMS\CustomPostTypes;

/**
 * Holds everything responsible for setting up the plugin, so that it can function 
 * like expected.
 */
class Init
{
    /**
     * Reference to all classes we want to be instantiating.
     */
    private static $classes = [
        Admin\PluginLinks::class,
        Admin\RenderSidebar::class,

        CustomPostTypes\CustomPostTypeController::class,
    ];

    /**
     * Make sure all setup for the Plugin is done. This method makes calls to all
     * methods that are needed for initialisation purposes.
     */
    public static function setup()
    {
        self::register_hooks();
        self::register_classes();

        add_action("admin_menu", fn() => self::add_admin_menu_separator(66));
        add_action("admin_menu", fn() => self::add_admin_menu_separator(69));
    }

    /**
     * Register different hooks, e.g. the ones responsible for Plugin activation.
     */
    private static function register_hooks()
    {
        register_activation_hook(__FILE__, [self::instantiate(Activation::class), "activate"]);
        register_deactivation_hook(__FILE__, [self::instantiate(Deactivation::class), "deactivate"]);
    }

    /**
     * Make sure each class is instantiated. If there is a `register()` method in the class,
     * call it as well.
     */
    private static function register_classes()
    {
        foreach (self::$classes as $class) {
            $instance = self::instantiate($class);

            if (method_exists($instance, "register")) {
                $instance->register();
            }
        }
    }

    /**
     * Create an instance of the given class.
     * @param mixed $class Class to instantiate.
     * @return object New instance of the class.
     */
    private static function instantiate($class)
    {
        return new $class();
    }

    /**
     * Add a seperator in the admin sidebar.
     * @param int $position Index of the seperator
     * @todo This feels like a very hacky way of adding seperators. Look into doing it some other way in the future.
     */
    public static function add_admin_menu_separator($position)
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