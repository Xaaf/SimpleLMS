<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS\API;

/**
 * `SimpleLMSSettings` is an API to tap into the WordPress settings, e.g. the sidebar on
 * the admin menu.
 */
class SimpleLMSSettings
{
    private $admin_pages = array();

    public function register()
    {
        if (!empty($this->admin_pages)) {
            add_action("admin_menu", array($this, "add_admin_menu"));
        }
    }

    /**
     * Add page to the settings menu for SimpleLMS.
     * @param array $page  Page to add.
     * @return `SimpleLMSSettings` Reference to the updated object.
     */
    public function add_pages(array $pages)
    {
        $this->admin_pages = $pages;

        return $this;
    }

    /**
     * Add all the pages we have to the WordPress admin menu.
     */
    function add_admin_menu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['slug'], $page['callback'], $page['icon_url'], $page['position']);
        }
    }
}