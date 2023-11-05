<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\Shortcodes;

class ShortcodeController
{
    /**
     * Reference of all Shortcodes we want to instantiate.
     */
    private static $classes = [
        CourseListShortcode::class,
    ];

    public function register()
    {
        foreach (self::$classes as $class) {
            $instance = self::instantiate($class);

            if (!shortcode_exists($instance->get_tag())) {
                add_shortcode($instance->get_tag(), [$instance, "callback"]);
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