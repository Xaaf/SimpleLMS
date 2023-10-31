<?php

/**
 * @package           SimpleLMS
 */

namespace SimpleLMS;

use WP_Query;

/**
 * `SimpleLMSCourseList` holds the shortcode for displaying the course list.
 */
class SimpleLMSCourseList
{
    private $tag = "slms_course_list";

    public function register()
    {
        if (!shortcode_exists($this->tag)) {
            add_shortcode($this->tag, [$this, "callback"]);
        }
    }

    function callback($attribs = [], $content = null)
    {
        $output = "";

        $query_args = [
            "post_type" => "course",
            "posts_per_page" => "25",
        ];

        $query = new WP_Query($query_args);

        while ($query->have_posts()) {
            $query->the_post();

            $output .= '<div class="course-listing">'
                . '<h2>' . the_title('', '', false) . '</h2>'
                . '</div>';
        }

        return $output;
    }
}