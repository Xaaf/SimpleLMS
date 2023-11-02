<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\Admin;

/**
 * Holds methods for handling different things related to the sidebar, e.g. registering the pages.
 */
class Sidebar
{
    /**
     * Pages to load in the admin sidebar.
     * @var array
     */
    private $pages = [];

    /**
     * Subpages to load in the admin sidebar.
     * @var array
     */
    private $subpages = [];

    /**
     * Groups of options in the admin menu.
     * @var array
     */
    private $groups = [];
    
    /**
     * Sections of options in the admin menu.
     * @var array
     */
    private $sections = [];

    /**
     * Fields that contain options in the admin menu.
     * @var array
     */
    private $fields = [];

    public function register()
    {
        if (!empty($this->pages)) {
            add_action("admin_menu", [$this, "add_admin_menus"]);
        }

        if (!empty($this->groups)) {
            add_action("admin_init", [$this, "add_admin_fields"]);
        }
    }

    /**
     * Add page(s) to the settings menu.
     * @param array $pages Page(s) to add.
     * @return static Reference to the updated object, to allow for method chaining.
     */
    public function add_pages(array $pages)
    {
        $this->pages = array_merge($this->pages, $pages);
        return $this;
    }

    /**
     * Add subpage(s) to the settings menu.
     * @param array $subpages Subpage(s) to add.
     * @return static Reference to the updated object, to allow for method chaining.
     */
    public function add_subpages(array $subpages)
    {
        $this->subpages = array_merge($this->subpages, $subpages);
        return $this;
    }

    /**
     * Modify the title of the top-level page.
     * @param string $menu_title New title for the page.
     * @return static Reference to the updated object, to allow for method chaining.
     */
    function with_title(string $menu_title = null)
    {
        if (empty($this->pages)) {
            return $this;
        }

        $page = $this->pages[0];
        $subpage = [
            [
                "parent_slug" => $page["slug"],
                "page_title" => $page["page_title"],
                "menu_title" => ($menu_title) ? $menu_title : $page["menu_title"],
                "capability" => $page["capability"],
                "slug" => $page["slug"],
                "callback" => $page["callback"]
            ]
        ];

        $this->subpages = $subpage;
        return $this;
    }

    /**
     * Register and add the pages we have to the WordPress admin menu.
     */
    function add_admin_menus()
    {
        foreach ($this->pages as $page) {
            add_menu_page($page["page_title"], $page["menu_title"], $page["capability"], $page["slug"], $page["callback"], $page["icon_url"], $page["position"]);
        }

        foreach ($this->subpages as $page) {
            add_submenu_page($page["parent_slug"], $page["page_title"], $page["menu_title"], $page["capability"], $page["slug"], $page["callback"]);
        }
    }

    /**
     * Set the groups for the setings menu.
     * @param array $groups New groups list.
     * @return static Reference to the updated object, to allow for method chaining.
     */
    public function set_groups(array $groups) {
        $this->groups = $groups;
        return $this;
    }

    /**
     * Set the sections for the setings menu.
     * @param array $sections New sections list.
     * @return static Reference to the updated object, to allow for method chaining.
     */
    public function set_sections(array $sections) {
        $this->sections = $sections;
        return $this;
    }

    /**
     * Set the fields for the setings menu.
     * @param array $fields New fields list.
     * @return static Reference to the updated object, to allow for method chaining.
     */
    public function set_fields(array $fields) {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Register and add the groups, sections and fields to the pages we created.
     */
    function add_admin_fields()
    {
        foreach ($this->groups as $group) {
            register_setting($group["option_group"], $group["option_name"], (isset($group["callback"]) ? $group["callback"] : ""));
        }

        foreach ($this->sections as $section) {
            add_settings_section($section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"] : ""), $section["page"]);
        }

        foreach ($this->fields as $field) {
            add_settings_field($field["id"], $field["title"], (isset($field["callback"]) ? $field["callback"] : ""), $field["page"], $field["section"], (isset($field["args"]) ? $field["args"] : ""));
        }
    }
}