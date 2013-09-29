<?php
/**
 * Mahara: Electronic portfolio, weblog, resume builder and social networking
 * Copyright (C) 2006-2013 Catalyst IT Ltd and others; see:
 *                         http://wiki.mahara.org/Contributors
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    mahara
 * @subpackage blocktype-progressbar
 * @author     Gregor Anzelj
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2013 Gregor Anzelj <gregor.anzelj@gmail.com>
 *
 */

defined('INTERNAL') || die();

class PluginBlocktypeProgressBar extends SystemBlocktype {

    public static function get_title() {
        return get_string('title', 'blocktype.progressbar');
    }

    public static function get_description() {
        return get_string('description', 'blocktype.progressbar');
    }

    public static function single_only() {
        return true;
    }

    public static function get_categories() {
        return array('internal');
    }

    public static function get_viewtypes() {
        return array('dashboard');
    }

    public static function render_instance(BlockInstance $instance, $editing=false) {
        global $USER;
        $owner = $instance->get_view()->get('owner');
        if (!$owner) {
            return '';
        }
        $userid = (!empty($USER) ? $USER->get('id') : 0);
        
        // Each user has firstname, lastname and email
        // so Profile completeness initial value: 5%
        $progress = new StdClass;
        $progress->value = 5;
        
        // Get all artefacts of a user
        $artefacts = get_column('artefact', 'artefacttype', 'owner', $userid);

        // Profile picture: 5%
        $progress->profileicon = 5;
        if (in_array('profileicon', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->profileicon = $progress->profileicon - 5;
        }
        // Personal information: 5%
        $progress->personalinformation = 5;
        if (in_array('personalinformation', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->personalinformation = $progress->personalinformation - 5;
        }
        // Contact information: 15%
        // - Address and country: 5%
        // - Any phone number: 5%
        // - Any webpage: 5%
        $progress->contactinformation = 15;
        if (in_array('address', $artefacts) &&
            in_array('country', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->contactinformation = $progress->contactinformation - 5;
        }
        if (in_array('businessnumber', $artefacts) ||
            in_array('homenumber', $artefacts) ||
            in_array('mobilenumber', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->contactinformation = $progress->contactinformation - 5;
        }
        if (in_array('blogaddress', $artefacts) ||
            in_array('officialwebsite', $artefacts) ||
            in_array('personalwebsite', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->contactinformation = $progress->contactinformation - 5;
        }
        // Messaging or social websites: 5%
        $progress->messaging = 5;
        if (in_array('icqnumber', $artefacts) ||
            in_array('msnnumber', $artefacts) ||
            in_array('aimscreenname', $artefacts) ||
            in_array('yahoochat', $artefacts) ||
            in_array('skypeusername', $artefacts) ||
            in_array('jabberusername', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->messaging = $progress->messaging - 5;
        }
        // Self-description (introduction or coverletter): 5%
        $progress->selfdescription = 5;
        if (in_array('introduction', $artefacts) ||
            in_array('coverletter', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->selfdescription = $progress->selfdescription - 5;
        }
        // Employment: 10%
        // - Education history: 5%
        // - Employment history: 5%
        $progress->employment = 10;
        if (in_array('educationhistory', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->employment = $progress->employment - 5;
        }
        if (in_array('employmenthistory', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->employment = $progress->employment - 5;
        }
        // Achievements: 15%
        // - Books: 5%
        // - Certifications: 5%
        // - Memberships: 5%
        $progress->achievements = 15;
        if (in_array('book', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->achievements = $progress->achievements - 5;
        }
        if (in_array('certification', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->achievements = $progress->achievements - 5;
        }
        if (in_array('membership', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->achievements = $progress->achievements - 5;
        }
        // Goals: 15%
        // - Personal goals: 5%
        // - Academic goals: 5%
        // - Career goals: 5%
        $progress->goals = 15;
        if (in_array('personalgoal', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->goals = $progress->goals - 5;
        }
        if (in_array('academicgoal', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->goals = $progress->goals - 5;
        }
        if (in_array('careergoal', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->goals = $progress->goals - 5;
        }
        // Skills: 15%
        // - Personal skills: 5%
        // - Academic skills: 5%
        // - Work skills: 5%
        $progress->skills = 15;
        if (in_array('personalskill', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->skills = $progress->skills - 5;
        }
        if (in_array('academicskill', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->skills = $progress->skills - 5;
        }
        if (in_array('workskill', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->skills = $progress->skills - 5;
        }
        // Interests: 5%
        $progress->interests = 5;
        if (in_array('interest', $artefacts)) {
            $progress->value = $progress->value + 5;
            $progress->interests = $progress->interests - 5;
        }
        
        $smarty = smarty_core();
        $smarty->assign('progress', $progress);
        return $smarty->fetch('blocktype:progressbar:progressbar.tpl');
    }

    public static function has_instance_config() {
        return false;
    }

    public static function has_config() {
        return false;
    }

    public static function postinst($prevversion) {
        if ($prevversion == 0) {
            /*
             * Add this blocktype to all existing dashboards - this include
             * existing users' dashboards and system dashboard view template.
             * Updating system dashboard view template will ensure that each
             * new user will have profile completeness / progress bar on their
             * dashboard...
             *
             */
            $dashboardids = get_column('view', 'id', 'type', 'dashboard');
            foreach ($dashboardids as $dashboardid) {
                insert_record('block_instance', array(
                    'blocktype' => 'progressbar',
                    'title'     => get_string('title', 'blocktype.progressbar'),
                    'view'      => $dashboardid,
                    'column'    => 2,
                    'order'     => 0, // At the top of the column
                    'row'       => 1,
                ));
            }
        }
    }

    public static function default_copy_type() {
        return 'shallow';
    }

    /**
     * Profile completeness/progress bar only makes sense on dashboard viewtypes
     */
    public static function allowed_in_view(View $view) {
        return $view->get('type') == 'dashboard';
    }

}
