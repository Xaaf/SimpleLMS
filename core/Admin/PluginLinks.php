<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\Admin;

/**
 * Responsible for handling the links displayed on the `Plugins` page.
 */
class PluginLinks
{
    public function register()
    {
        add_filter("plugin_action_links_" . SIMPLELMS_NAME, [$this, "set_links"]);
    }

    /**
     * Set the links to have our custom links in them.
     * @param mixed $links  Links to be added to.
     * @return array        Array with our own links added in.
     */
    function set_links($links)
    {
        array_push($links, '<a href="admin.php?page=simplelms_config">Configuration</a>');
        return $links;
    }
}