<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\CustomPostTypes;

/**
 * Abstracted version of a Custom Post Type, for easier implementation.
 */
abstract class CustomPostType
{
    /**
     * Handle to register this post type.
     */
    function register()
    {
        register_post_type($this->get_key(), $this->get_args());
    }

    function register_metas()
    {
    }

    /**
     * Get the post type key.
     * @return string Key-value
     */
    abstract function get_key();

    /**
     * Get the labels that this post type uses.
     * @return array Labels
     */
    abstract function get_labels();

    /**
     * Get the arguments for this post type.
     * @return array Arguments
     */
    abstract function get_args();
}