<?php

/**
 * Plugin Name
 *
 * @package           SimpleLMS
 * @author            Xavi van Dalen
 * @copyright         2023 Xavi van Dalen
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       SimpleLMS
 * Plugin URI:        https://xaaf.dev/SimpleLMS
 * Description:       LMS made simple.
 * Version:           1.0.0-dev
 * Requires at least: 6.3
 * Requires PHP:      7.2
 * Author:            Xavi van Dalen
 * Author URI:        https://xaaf.dev
 * Text Domain:       simplelms
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Update URI:        https://xaaf.dev/SimpleLMS/
 */

/*
SimpleLMS is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

SimpleLMS is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with SimpleLMS. If not, see https://www.gnu.org/licenses/gpl-3.0.txt.
*/

// Don't expose information
if (!function_exists("add_action")) {
    echo "You're not supposed to be here...";
    exit;
}

// Set up SimpleLMS paths for easy access
define("PLUGIN_PATH", plugin_dir_path(__FILE__));
define("PLUGIN_URL", plugin_dir_url(__FILE__));

// Handle requires
require PLUGIN_PATH . "inc/simplelms-init.php";

// Initialisation and registering
if (class_exists("SimpleLMS\SimpleLMSInit")) {
    SimpleLMS\SimpleLMSInit::register_services();
}
