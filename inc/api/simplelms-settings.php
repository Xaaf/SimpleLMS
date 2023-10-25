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
    private $admin_pages = [];
    private $admin_subpages = [];

    private $settings = [];
    private $sections = [];
    private $fields = [];

    public function register()
    {
        if (!empty($this->admin_pages)) {
            add_action("admin_menu", [$this, "register_admin_menu"]);
        }

        if (!empty($this->settings)) {
            add_action("admin_init", [$this, "register_admin_fields"]);
        }
    }

    /**
     * Add page to the settings menu for SimpleLMS.
     * @param array $pages  Pages to add.
     * @return `SimpleLMSSettings` Reference to the updated object.
     */
    public function add_pages(array $pages)
    {
        $this->admin_pages = $pages;
        return $this;
    }

    /**
     * Add subpage to the settings menu for SimpleLMS.
     * @param array $subpages  Subpages to add.
     * @return `SimpleLMSSettings` Reference to the updated object.
     */
    public function add_subpages(array $subpages)
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $subpages);
        return $this;
    }

    /**
     * Change the title of this page.
     * @param string $menu_title    New title.
     * @return `SimpleLMSSettings` Reference to the updated object.
     */
    function with_title(string $menu_title = null)
    {
        // We don't have any pages, so no need for a sub-page.
        if (empty($this->admin_pages)) {
            return $this;
        }

        // Get a reference to the first page
        $admin_page = $this->admin_pages[0];
        $subpage = [
            [
                "parent_slug" => $admin_page["slug"],
                "page_title" => $admin_page["page_title"],
                "menu_title" => ($menu_title) ? $menu_title : $admin_page["menu_title"],
                "capability" => $admin_page["capability"],
                "slug" => $admin_page["slug"],
                "callback" => $admin_page["callback"]
            ]
        ];

        $this->admin_subpages = $subpage;
        return $this;
    }

    /**
     * Register all the pages we have to the WordPress admin menu.
     */
    function register_admin_menu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        foreach ($this->admin_subpages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['slug'], $page['callback']);
        }
    }

    public function set_settings(array $settings)
    {
        $this->settings = $settings;
        return $this;
    }

    public function set_sections(array $sections)
    {
        $this->sections = $sections;
        return $this;
    }

    public function set_fields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    function register_admin_fields()
    {
        foreach ($this->settings as $setting) {
            register_setting($setting["option_group"], $setting["option_name"], (isset($setting["callback"]) ? $setting["callback"] : ""));
        }

        foreach ($this->sections as $section) {
            add_settings_section($section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"] : ""), $section["page"]);
        }

        foreach ($this->fields as $field) {
            add_settings_field($field["id"], $field["title"], (isset($field["callback"]) ? $field["callback"] : ""), $field["page"], $field["section"], (isset($field["args"]) ? $field["args"] : ""));
        }
    }
}