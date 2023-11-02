<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\CustomPostTypes;

/**
 * Controller holding everything related to the custom post-types we use in SimpleLMS.
 */
class CustomPostTypeController
{
    /**
     * Reference of all Custom Post Types we want to instantiate.
     */
    private static $classes = [
        CourseCPT::class,
    ];

    public function register()
    {
        self::register_cpts();
    }

    private static function register_cpts()
    {
        foreach (self::$classes as $class) {
            $instance = self::instantiate($class);

            add_action("init", [$instance, "register"]);
            $instance->register_metas();
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