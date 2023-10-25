<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS\API\Callbacks;

/**
 * `SimpleLMSAdminCallbacks` holds all admin-related callbacks.
 */
class SimpleLMSAdminCallbacks
{
    /**
     * Retrieve the admin SimpleLMS dashboard template.
     * @return mixed
     */
    public function admin_dashboard()
    {
        return require(SIMPLELMS_PATH . "/templates/admin/dashboard.php");
    }

    /**
     * Retrieve the admin SimpleLMS courses template.
     * @return mixed
     */
    public function admin_courses()
    {
        return require(SIMPLELMS_PATH . "/templates/admin/courses.php");
    }

    /**
     * Retrieve the admin SimpleLMS lessons template.
     * @return mixed
     */

    public function admin_lessons()
    {
        return require(SIMPLELMS_PATH . "/templates/admin/lessons.php");
    }
    /**
     * Retrieve the admin SimpleLMS configuration template.
     * @return mixed
     */
    public function admin_configuration()
    {
        return require(SIMPLELMS_PATH . "/templates/admin/configuration.php");
    }

    public function admin_options_group($input)
    {
        return $input;
    }

    public function admin_section()
    {
        echo "Some section here!";
    }

    public function admin_fields_some()
    {
        $value = esc_attr(get_option("some_field"));
        echo '<input type="text" class="regular-text" name="some_field" value="' . $value . '" placeholder="Some text...">';
    }

    public function admin_fields_other()
    {
        $value = esc_attr(get_option("some_other_field"));
        echo '<input type="text" class="regular-text" name="some_other_field" value="' . $value . '" placeholder="Some more text...">';
    }
}