<?php

/**
 * @package SimpleLMS
 */

namespace SimpleLMS\Shortcodes;

use WP_Query;

class CourseListShortcode extends Shortcode
{
    function get_tag()
    {
        return "slms_course_list";
    }

    function callback($attributes = [], $content = null)
    {
        $output = "";

        $query = new WP_Query([
            "post_type" => "course",
            "post_status" => "publish",
            "posts_per_page" => 50,
        ]);

        $output .= '<div class="course-list">';

        while ($query->have_posts()) {
            $query->the_post();

            $title = get_the_title();
            $excerpt = get_the_excerpt();

            $output .= '<div class="course-listing">'
                . '<h2 class="course-title">' . $title . '</h2>'
                . '<p class="course-description">' . $excerpt . '</p>'
                . '</div>';
        }

        $output .= '</div>';

        wp_reset_query();

        return $output;
    }
}