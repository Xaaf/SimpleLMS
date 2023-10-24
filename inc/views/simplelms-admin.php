<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS\Views;

use SimpleLMS;

require SIMPLELMS_PATH . "inc/api/simplelms-settings.php";

/**
 * `SimpleLMSAdmin` holds all methods related to the admin view.
 */
class SimpleLMSAdmin
{
    private $settings;
    private $pages = [];
    private $subpages = [];

    function __construct()
    {
        $this->settings = new SimpleLMS\API\SimpleLMSSettings;

        $this->pages = [
            [
                "page_title" => "SimpleLMS",
                "menu_title" => "SimpleLMS",
                "capability" => "manage_options",
                "slug" => "simplelms",
                "callback" => function () {
                    echo "<h1>SimpleLMS</h1>";
                },
                "icon_url" => "dashicons-welcome-learn-more",
                "position" => 59 // Right after the seperator, before `Appearance`
            ]
        ];

        $this->subpages = [
            [
                "parent_slug" => "simplelms",
                "page_title" => "Custom Post Types",
                "menu_title" => "Custom Post Types",
                "capability" => "manage_options",
                "slug" => "simplelms_cpt",
                "callback" => function () {
                    echo "<h1>Custom Post Types</h1>";
                }
            ],
            [
                "parent_slug" => "simplelms",
                "page_title" => "Courses",
                "menu_title" => "Courses",
                "capability" => "manage_options",
                "slug" => "simplelms_courses",
                "callback" => function () {
                    echo "<h1>Courses</h1>";
                }
            ],
            [
                "parent_slug" => "simplelms",
                "page_title" => "Configuration",
                "menu_title" => "Configuration",
                "capability" => "manage_options",
                "slug" => "simplelms_config",
                "callback" => function () {
                    echo "<h1>Configuration</h1>";
                }
            ]
        ];

    }

    public function register()
    {
        // add_action("admin_menu", array($this, "add_admin_menu"));
        $this->settings->add_pages($this->pages)->with_subpage("Dashboard")->add_subpages($this->subpages)->register();
    }
}