<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\Shortcodes;

abstract class Shortcode
{
    /**
     * Get the tag for this shortcode.
     * @return string
     */

    abstract function get_tag();
    /**
     * Implementation of this shortcode. Gets called whenever the shortcode is inserted on a page.
     * @param mixed $attributes Attributes given with the shortcode.
     * @param mixed $content Content of the shortcode.
     */
    abstract function callback($attributes = [], $content = null);
}