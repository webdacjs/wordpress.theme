<?php

/**
 * Models, controllers, hooks and crooks for data served out of stisrv13.epfl.ch
 */

namespace EPFL\STI;

if (! defined('ABSPATH')) {
    die('Access denied.');
}

function _stisrv13_metadata ($person_obj) {
    if (! $person_obj->_stisrv13_metadata) {
        $incoming_json = @file_get_contents('https://stisrv13.epfl.ch/cgi-bin/whoop/peoplepage.pl?sciper=' . $person_obj->get_sciper());
        if ($incoming_json) {
            $person_obj->_stisrv13_metadata = json_decode($incoming_json);
        }
    }

    return $person_obj->_stisrv13_metadata;
}

add_filter('epfl_person_bio', function($biography, $person_obj) {
    $s13 = _stisrv13_metadata($person_obj);
    if ($s13 && $s13->bio) {
        return $s13->bio;
    } else {
        return $biography;
    }
}, 10, 3);