<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS\Views;

use SimpleLMS;

require SIMPLELMS_PATH . "inc/api/simplelms-settings.php";
require SIMPLELMS_PATH . "inc/api/callbacks/simplelms-admin-callbacks.php";

/**
 * `SimpleLMSAdmin` holds all methods related to the admin view.
 */
class SimpleLMSAdmin
{
    private $settings;
    private $callbacks;

    private $pages = [];
    private $subpages = [];

    public function register()
    {
        $this->settings = new SimpleLMS\API\SimpleLMSSettings;
        $this->callbacks = new SimpleLMS\API\Callbacks\SimpleLMSAdminCallbacks;

        $this->set_pages();
        $this->set_subpages();

        $this->set_setting_values();
        $this->set_section_values();
        $this->set_field_values();

        $this->settings->add_pages($this->pages)->with_title("Dashboard")->add_subpages($this->subpages)->register();
    }

    private function set_pages()
    {
        $this->pages = [
            [
                "page_title" => "SimpleLMS",
                "menu_title" => "SimpleLMS",
                "capability" => "manage_options",
                "slug" => "simplelms",
                "callback" => [$this->callbacks, "admin_dashboard"],
                "icon_url" => "dashicons-welcome-learn-more",
                "position" => 59 // Right after the seperator, before `Appearance`
            ]
        ];
    }

    private function set_subpages()
    {
        $this->subpages = [
            [
                "parent_slug" => "simplelms",
                "page_title" => "Courses",
                "menu_title" => "Courses",
                "capability" => "manage_options",
                "slug" => "simplelms_courses",
                "callback" => [$this->callbacks, "admin_courses"],
            ],
            [
                "parent_slug" => "simplelms",
                "page_title" => "Lessons",
                "menu_title" => "Lessons",
                "capability" => "manage_options",
                "slug" => "simplelms_lessons",
                "callback" => [$this->callbacks, "admin_lessons"],
            ],
            [
                "parent_slug" => "simplelms",
                "page_title" => "Configuration",
                "menu_title" => "Configuration",
                "capability" => "manage_options",
                "slug" => "simplelms_config",
                "callback" => [$this->callbacks, "admin_configuration"],
            ]
        ];
    }

    private function set_setting_values()
    {
        $values = [
            [
                // ID for the option group
                "option_group" => "simplelms_admin_options_group",

                // ID for this option's field
                "option_name" => "some_field",

                // Callback for this option
                "callback" => [$this->callbacks, "admin_options_group"]
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

        $this->settings->set_settings($values);
    }

    private function set_section_values()
    {
        $values = [
            [
                // ID for this section
                "id" => "simplelms_admin_index",

                // Title for this section
                "title" => "Settings",

                // Callback for this section
                "callback" => [$this->callbacks, "admin_section"],

                // Slug for this section
                // --> This should be the slug of the page where this should appear!
                "page" => "simplelms"
            ]
        ];

        $this->settings->set_sections($values);
    }

    private function set_field_values()
    {
        $values = [
            [
                // Needs to be identical to `option_name`
                "id" => "some_field",

                // Title/Label for the field
                "title" => "Placeholder Text",

                // Callback for the field
                "callback" => [$this->callbacks, "admin_fields_some"],

                // Slug for the page where we want this section to be
                "page" => "simplelms",

                // ID for the section to which this field belongs
                "section" => "simplelms_admin_index",

                // Some optional arguments
                "args" => []
            ],
            [
                // Needs to be identical to `option_name`
                "id" => "some_other_field",

                // Title/Label for the field
                "title" => "More Placeholder Text",

                // Callback for the field
                "callback" => [$this->callbacks, "admin_fields_other"],

                // Slug for the page where we want this section to be
                "page" => "simplelms",

                // ID for the section to which this field belongs
                "section" => "simplelms_admin_index",
                
                // Some optional arguments
                "args" => []
            ]
        ];

        $this->settings->set_fields($values);
    }
}