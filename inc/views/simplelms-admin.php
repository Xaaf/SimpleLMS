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
            ],
        ];
    }

    public function register()
    {
        // add_action("admin_menu", array($this, "add_admin_menu"));
        $this->settings->add_pages($this->pages)->register();
    }
}