<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

require SIMPLELMS_PATH . "inc/base/shortcodes/simplelms-course-list.php";

/**
 * `SimpleLMSShortcodes` is responsible for making sure all shortcodes are ready to be used.
 */
final class SimpleLMSShortcodes
{
    public function register()
    {
        $this->register_shortcodes();
    }

    /**
     * Keeps all the classes of all shortcodes in an array.
     * @return array List of all shortcodes.
     */
    public static function get_shortcodes()
    {
        return [
            SimpleLMSCourseList::class,
        ];
    }

    /**
     * Register each class as a shortcode. Calls the `register()` method
     * if it exists for that shortcode.
     */
    public static function register_shortcodes()
    {
        foreach (self::get_shortcodes() as $class) {
            $shortcode = self::instantiate($class);

            if (method_exists($shortcode, "register")) {
                $shortcode->register();
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