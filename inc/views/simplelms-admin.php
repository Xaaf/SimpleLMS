<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS\Views;

/**
 * `SimpleLMSAdmin` holds all methods related to the admin view.
 */
class SimpleLMSAdmin
{
    function __construct()
    {
    }

    public function register()
    {
        add_action("admin_menu", array($this,"add_admin_menu"));
    }

    /**
     * Create the menu item for SimpleLMS.
     */
    public function add_admin_menu()
    {
        add_menu_page("SimpleLMS", "SimpleLMS", "manage_options", "simplelms", array($this,"admin_view_callback"), "dashicons-welcome-learn-more", 59);
    }

    /**
     * Create the view for the SimpleLMS admin page.
     */
    public function admin_view_callback()
    {
        require_once PLUGIN_PATH . "templates/admin.php";
    }
}