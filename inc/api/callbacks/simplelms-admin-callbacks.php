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
}