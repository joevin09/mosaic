<?php

if (!function_exists('secondsToTime')) {

    function secondsToTime($time) {
        $seconds = $time % 60;
        $time = ($time - $seconds) / 60;
        $minutes = $time % 60;
        $hours = ($time - $minutes) / 60;
        return $hours . 'h ' . sprintf('%02d', $minutes) . 'm';
    }

}

if (!function_exists('timeleft')) {

    function timeleft($date) {
        $now = time();
        $date = strtotime($date);
        if ($now < $date) {
            $ret = timespan($now, $date);
        } else {
            $ret = "Il y a " . timespan($date, $now);
        }
        return $ret;
    }

}

if (!function_exists('timeago')) {

    function timeago($date) {
        $now = time();
        $date = strtotime($date);
        $ret = timespan($date);

        $ret = explode(", ", $ret);
        $ret = $ret[0];
        if ($date < $now) {
            $ret = "Il y a " . $ret;
        }
        return $ret;
    }

}

if (!function_exists('getNextMardi')) {

    function getNextMardi($next = 1) {
        $now = time() + ($next - 1) * 3600 * 24 * 7;
        $mardi = 0;
        return strftime('%e %B', strtotime('tuesday', $now));
    }

}
