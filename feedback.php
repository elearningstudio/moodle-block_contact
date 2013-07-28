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

require_once('../../config.php');
require_once('feedback_form.php');

require_login();
$context = get_context_instance(CONTEXT_COURSE, '1');
$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot . '/blocks/contact/feedback.php');
$PAGE->set_pagelayout('course');
$PAGE->set_title(get_string('pluginname', 'block_contact'));
$PAGE->set_heading(get_string('pluginname', 'block_contact'));
$mform = new block_contact_form(null);

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . '/index.php');
} else if ($data = $mform->get_data()) {

    $messagetext = $data->message;
    $admin1 = get_config('block_contact', 'email1');
    $admin1user = $DB->get_record('user', array('email' => $admin1));
    $admin2 = get_config('block_contact', 'email2');
    $admin2user = $DB->get_record('user', array('email' => $admin2));
    $subject = get_string('feedbackemail', 'block_contact');

    if ($sent1 = email_to_user($admin1user, $USER, $subject, $messagetext)) {
        $sent1 = true;
    } else {
        $sent1 = false;
    }
    if ($sent2 = email_to_user($admin2user, $USER, $subject, $messagetext)) {
        $sent2 = true;
    } else {
        $sent2 = false;
    }
    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('pluginname', 'block_contact'));

    if ($sent1 == false || $sent2 == false) {
        $message = get_string('emailerror', 'block_contact');
    } else {
        $message = get_string('emailsuccess', 'block_contact');
    }
    echo html_writer::tag('span', $message, array('class' => 'error bold red'));
    $mform->display();
    echo $OUTPUT->footer();

} else {

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('pluginname', 'block_contact'));

    $mform->display();

    echo $OUTPUT->footer();
}
