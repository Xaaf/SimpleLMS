<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\Admin;

/**
 * Responsible for handling what should be rendered for the sidebar.
 */
class RenderSidebar
{
    private $sidebar;

    /**
     * List of pages we want in the Admin sidebar.
     */
    private $pages;
    
    /**
     * List of subpages we want.
     */
    private $subpages;

    public function register()
    {
        $this->sidebar = new Sidebar();

        $this->set_pages();
        $this->set_values();

        $this->sidebar->add_pages($this->pages)
            ->with_title("Dashboard")
            ->add_subpages($this->subpages)
            ->register();
    }

    /**
     * Initialise the `pages` and `subpages` variables with their respective details.
     */
    private function set_pages()
    {
        $this->pages = [
            [
                "page_title" => "SimpleLMS",
                "menu_title" => "SimpleLMS",
                "capability" => "manage_options",
                "slug" => "simplelms",
                "callback" => [$this, "dashboard_callback"],
                "icon_url" => "dashicons-welcome-learn-more",
                "position" => 67 // Right after `Plugins` and the seperator, before `Appearance`
            ],
        ];

        $this->subpages = [
            [
                "parent_slug" => "simplelms",
                "page_title" => "Configuration",
                "menu_title" => "Configuration",
                "capability" => "manage_options",
                "slug" => "simplelms_config",
                "callback" => [$this, "configuration_callback"],
            ],
        ];
    }

    /**
     * Initialise the `groups`, `sections` and `fields` variables with their respective values.
     */
    private function set_values()
    {
        $groups = [
            [
                // ID for the option group
                "option_group" => "simplelms_admin_options_group",

                // ID for this option's field
                "option_name" => "some_field",

                // Callback for this option
                "callback" => ""
            ],
            [
                // ID for the option group
                "option_group" => "simplelms_admin_options_group",

                // ID for this option's field
                "option_name" => "some_other_field",

                // Callback for this option
                "callback" => ""
            ]
        ];

        $sections = [
            [
                // ID for this section
                "id" => "simplelms_admin_index",

                // Title for this section
                "title" => "Settings",

                // Callback for this section
                "callback" => "",

                // Slug for this section
                // --> This should be the slug of the page where this should appear!
                "page" => "simplelms"
            ]
        ];

        $fields = [
            [
                // Needs to be identical to `option_name`
                "id" => "some_field",

                // Title/Label for the field
                "title" => "Placeholder Text",

                // Callback for the field
                "callback" => "",

                // Slug for the page where we want this section to be
                "page" => "simplelms",

                // ID for the section to which this field belongs
                "section" => "simplelms_admin_index",

                // Some optional arguments
                "args" => []
            ]
        ];

        $this->sidebar->set_groups($groups);
        $this->sidebar->set_sections($sections);
        $this->sidebar->set_fields($fields);
    }

    /**
     * Callback for rendering the Dashboard page.
     * @return mixed Dashboard page. 
     */
    function dashboard_callback()
    {
        return require(SIMPLELMS_PATH . "/templates/admin/dashboard.php");
    }

    /**
     * Callback for rendering the Configuration page.
     * @return mixed Configuration page.
     */
    function configuration_callback()
    {
        return require(SIMPLELMS_PATH . "/templates/admin/configuration.php");    
    }
}