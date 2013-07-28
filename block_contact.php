<?php
// This file is part of the contact block for Moodle
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    block
 * @subpackage contact
 * @copyright  2013 onwards Barry Oosthuizen (http://elearningstudio.co.uk)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (is_file($CFG->dirroot.'/mod/contact/lib.php')) {
    require_once($CFG->dirroot.'/mod/contact/lib.php');
    define('contact_BLOCK_LIB_IS_OK', true);
}

class block_contact extends block_list {

    function init() {
        $this->title = get_string('contact', 'block_contact');
    }

    function applicable_formats() {
        return array('site' => true, 'course' => true);
    }

    function get_content() {
        global $CFG, $OUTPUT;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $courseid = $this->page->course->id;
        if ($courseid <= 0) {
            $courseid = SITEID;
        }

        if (empty($this->instance->pageid)) {
            $this->instance->pageid = SITEID;
        }

        $baseurl = new moodle_url('/blocks/contact/feedback.php');

        $url = new moodle_url($baseurl);
        $url->params(array('courseid'=>$courseid));
        $this->content->items[] = '<a href="'.$url->out().'">'. get_string('feedbacklink', 'block_contact').'</a>';

        return $this->content;
    }
}
