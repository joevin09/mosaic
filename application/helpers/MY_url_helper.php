<?php

if (!function_exists('get_work_image')) {

    function get_work_image($user_id, $filename, $format = "thumb") {
        $dir = trim(get_user_directory($user_id), '/');
        return rtrim(base_url(array('uploads', $dir, $format, $filename)), '/');
    }

}
if (!function_exists('get_work_image_path')) {

    function get_work_image_path($user_id, $filename, $format = "thumb") {
        $dir = trim(get_user_directory($user_id), '/');
        $path = array('uploads', $dir, $format, $filename);
        return FCPATH . implode('/', $path);
    }

}
if (!function_exists('avatar_url')) {

    function avatar_url($url = "", $format = "") {
        $avatar = assets('img/img_avatar.png');
        if (!empty($url)) {
            $avatar = preg_replace('#/$#', '', site_url($url, FALSE));
            if (!empty($format)) {
                $av_infos = pathinfo($avatar);
                $avatar = $av_infos['dirname'] . '/' . $av_infos['filename'] . '_' . $format . '.' . $av_infos['extension'];
            }
        }
        return $avatar;
    }

}

if (!function_exists('switch_lang_url')) {

    function switch_lang_url($page_id = "", $lang_id = "") {
        $url = "#";
        $CI = & get_instance();
        if (!empty($page_id) && !empty($lang_id)) {
            $url = $CI->pages_model->get_permalink($page_id, $lang_id);
        } else if (empty($page_id)) {
            $url = explode('/', $CI->uri->uri_string());
            foreach ($CI->data['languages'] AS $v) {
                if ($v->id == $lang_id) {
                    $url[0] = $v->iso;
                }
            }
            $url = base_url($url);
        }
        return $url;
    }

}
if (!function_exists('localized_site_url')) {

    function localized_site_url($url = "") {
        if (is_array($url)) {
            array_unshift($url, config_item('lang'));
        } else {
            $url = config_item('lang') . "/" . ltrim($url, '/');
        }
        return site_url($url);
    }

}

if (!function_exists('base_url')) {

    /**
     * Base URL
     *
     * Create a local URL based on your basepath.
     * Segments can be passed in as a string or an array, same as site_url
     * or a URL to a file can be passed in, e.g. to an image file.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
    function base_url($uri = '', $protocol = NULL) {
        $uri = get_instance()->config->base_url($uri);
        if ($protocol || defined('PROTOCOL')) {
            $protocol = (!empty($protocol)) ? $protocol : PROTOCOL;
            return $protocol . substr($uri, strpos($uri, '://'));
        }
        return rtrim($uri, '/') . '/';
    }

}
if (!function_exists('image_url')) {

    function image_url($uri = '') {
        return rtrim(base_url($uri), '/');
    }

}


/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if (!function_exists('site_url')) {

    function site_url($uri = '', $query_string = TRUE) {
        $CI = & get_instance();
        if (defined('SIDE') && SIDE !== 'public') {
            if (is_array($uri) && $uri[0] !== SIDE) {
                array_unshift($uri, SIDE);
            } else if (!is_array($uri) && (!preg_match('#^' . SIDE . '#', $uri) || preg_match('#^' . SIDE . 's#', $uri))) {
                $uri = rtrim(SIDE . '/' . $uri, '/');
            }
        }
        $url = $CI->config->site_url($uri);
        if (!empty($_SERVER['QUERY_STRING']) && $query_string) {
            $query_string = explode("&", $_SERVER['QUERY_STRING']);
            $url_suffix = "";
            foreach ($query_string AS $v) {
                if (!preg_match('/^filter/i', $v)) {
                    // Check if variable has a value
                    $data = explode("=", $v);
                    if (!empty($data[1])) {
                        $url_suffix .= $v . "&";
                    }
                }
            }
            if (!empty($url_suffix)) {
                $url .= "?" . rtrim($url_suffix, '&');
            }
        }
        if (!empty($_REQUEST['signed_request']) && $query_string) {
            $sep = (!empty($_SERVER['QUERY_STRING'])) ? "&" : "?";
            $url .= $sep . "signed_request=" . $_REQUEST['signed_request'];
        }
        return $url;
    }

}

/**
 * Current URL
 *
 * Returns the full URL (including segments) of the page where this
 * function is placed
 *
 * @access	public
 * @return	string
 */
if (!function_exists('current_url')) {

    function current_url($query_string = TRUE) {
        $CI = & get_instance();
        $url = $CI->config->site_url($CI->uri->uri_string());
        if (!empty($_SERVER['QUERY_STRING']) && $query_string) {
            $url .= '?' . $_SERVER['QUERY_STRING'];
        }
        return $url;
    }

}

if (!function_exists('get_template_name')) {

    function get_template_name() {
        $tpl = config_item('template_' . SIDE);
        return(!empty($tpl)) ? $tpl : 'default';
    }

}

if (!function_exists('assets')) {

    function assets($file) {
        if (is_array($file)) {
            $file = implode('', $file);
        }
        if (!MY_DEBUG) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $ext_to_minify = array('css', 'js');
            $no_minify = array('modernizr');
            if (!preg_match('#\.min#i', $filename) && !preg_match('#(' . implode('|', $no_minify) . ')#', $filename) && in_array($ext, $ext_to_minify)) {
                $file = pathinfo($file, PATHINFO_DIRNAME) . '/' . $filename . '.min.' . $ext;
            }
        }
        $url = site_url(array('assets', SIDE, get_template_name(), $file), FALSE);
        return rtrim($url, '/');
    }

}

if (!function_exists('parser')) {

    function parser($file) {
        if (is_array($file)) {
            $file = implode('', $file);
        }
        return rtrim(site_url(array('parser/assets', $file), TRUE), '/');
    }

}



if (!function_exists('assets_email')) {

    function assets_email($file) {
        if (is_array($file)) {
            $file = implode('', $file);
        }
        return rtrim(base_url(array('assets/emails', $file)), '/');
    }

}

if (!function_exists('email_images_uploaded_dir')) {

    function email_images_uploaded_dir($template_id) {
        $template_id = sprintf('%04d', $template_id);
        return APPPATH . 'views/emails/_assets/images/uploads/' . $template_id;
    }

}

if (!function_exists('email_images_uploaded_url')) {

    function email_images_uploaded_url($template_id, $filename = "") {
        $template_id = sprintf('%04d', $template_id);
        return site_url(array('assets/emails/images/uploads', $template_id, $filename), FALSE);
    }

}

if (!function_exists('gravatar')) {

    function gravatar($email) {
        return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email)));
    }

}

if (!function_exists('return_back')) {

    function return_back($fallback = "") {
        $referer = $_SERVER['HTTP_REFERER'];
        $return_back = (!empty($fallback)) ? site_url($fallback) : site_url();
        if (getDomain() === getDomain($referer)) {
            $return_back = $referer;
        }
        return $return_back;
    }

}