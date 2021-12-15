<?php
// This file is part of Moodle - http://moodle.org/
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
 * Transforms data to formatted course summary.
 *
 * @package    mod_videotime
 * @copyright  2019 bdecent gmbh <https://bdecent.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_videotime\local\block_dash\attribute;

use block_dash\local\data_grid\field\attribute\abstract_field_attribute;

/**
 * Transforms data to formatted course summary.
 *
 * @package    mod_videotime
 * @copyright  2019 bdecent gmbh <https://bdecent.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class video_description_attribute extends abstract_field_attribute
{
    /**
     * After records are relieved from database each field has a chance to transform the data.
     * Example: Convert unix timestamp into a human readable date format
     *
     * @param int $data
     * @param \stdClass $record Entire row
     * @return mixed
     * @throws \moodle_exception
     */
    public function transform_data($data, \stdClass $record) {
        global $DB;

        $summary = '';
        if ($data && $course = $DB->get_record('course', ['id' => $data])) {
            $summary = file_rewrite_pluginfile_urls($course->summary, 'pluginfile.php',
                \context_course::instance($course->id)->id, 'course', 'summary', null);
            $summary = format_text($summary, $course->summaryformat);
        }

        return $summary;
    }
}
