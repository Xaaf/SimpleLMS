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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Set up the autoloader
if (file_exists(dirname(__FILE__) . "/vendor/autoload.php")) {
    require_once(dirname(__FILE__) . "/vendor/autoload.php");
}

define("SIMPLELMS_NAME", plugin_basename(__FILE__));
define("SIMPLELMS_PATH", plugin_dir_path(__FILE__));
define("SIMPLELMS_URL", plugin_dir_url(__FILE__));

SimpleLMS\Init::setup();
