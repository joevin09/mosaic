<?php

if (!function_exists('show_order_by')) {

    function show_order_by($field, $str) {
        $urlarray = explode('?', current_url());
        $query = (isset($urlarray[1])) ? $urlarray[1] : "";
        parse_str($query, $queryarray);
        $queryarray['order'] = $field;
        if ($field == $_GET['order']) {
            $queryarray['by'] = ($queryarray['by'] == 'DESC' || $_GET['by'] == "DESC") ? 'ASC' : 'DESC';
        } else {
            $queryarray['by'] = 'DESC';
        }
        $queryarray = http_build_query($queryarray);
        $link = $urlarray[0] . '?' . $queryarray;
        if ($_GET['order'] == $field || (!$_GET['order'] && $field == 'id')) {
            if ($_GET['by'] == 'ASC' || !$_GET['by']) {
                $caret = '<i class="fa fa-caret-down"></i>';
            } else {
                $caret = '<i class="fa fa-caret-up"></i>';
            }
        }
        $ret .= '<a href="' . $link . '">' . $str . ' ' . $caret . '</a>';
        return $ret;
    }

}
if (!function_exists('add_querystring_var')) {

    function add_querystring_var($key, $value, $url = "") {
        if (empty($url)) {
            $url = current_url();
        }
        $urlarray = explode('?', $url);
        $query = '';
        if (isset($urlarray[1])) {
            $query = rawurldecode($urlarray[1]);
        }
        parse_str($query, $queryarray);

        $queryarray[$key] = $value;

        $queryarray = http_build_query($queryarray);

        return $urlarray[0] . '?' . $queryarray;
    }

}