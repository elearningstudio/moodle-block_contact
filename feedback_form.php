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

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/formslib.php');

class block_contact_form extends moodleform {

    function definition() {
        global $USER, $CFG, $DB;

        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('message', 'block_contact'));
        $mform->addElement('textarea', 'message', '', 'wrap="virtual" rows="10" cols="80"');
        $mform->addElement('submit', 'submit', get_string('sendemail', 'block_contact'));

    }

}
