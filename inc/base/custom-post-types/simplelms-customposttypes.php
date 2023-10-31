<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

require SIMPLELMS_PATH . "inc/base/custom-post-types/simplelms-course-cpt.php";

/**
 * `SimpleLMSCustomPostTypes` is responsible for registering the custom post types used in the plugin.
 */
final class SimpleLMSCustomPostTypes
{
    /**
     * Keeps all the classes of all custom post types in an array.
     * @return array List of all custom post types.
     */
    public static function get_post_types()
    {
        return [
            SimpleLMSCourseCPT::class,
        ];
    }

    public function register()
    {
        foreach(self::get_post_types() as $class) {
            $post_type = self::instantiate($class);

            add_action("init", [$post_type, "register_cpt"]);
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