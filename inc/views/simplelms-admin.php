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
        $this->settings->add_pages($this->pages)->with_subpage("Dashboard")->add_subpages($this->subpages)->register();
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
                "callback" => [ $this->callbacks,"admin_courses"],
            ],
            [
                "parent_slug" => "simplelms",
                "page_title" => "Lessons",
                "menu_title" => "Lessons",
                "capability" => "manage_options",
                "slug" => "simplelms_lessons",
                "callback" => [$this->callbacks,"admin_lessons"],
            ],
            [
                "parent_slug" => "simplelms",
                "page_title" => "Configuration",
                "menu_title" => "Configuration",
                "capability" => "manage_options",
                "slug" => "simplelms_config",
                "callback" => [$this->callbacks,"admin_configuration"],
            ]
        ];
    }
}