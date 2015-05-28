<?php

/**
 * Return the country code phone
 * 
 * @param string ISO Code (2 letters) of the country
 * @return integer
 */
if (!function_exists('country_code_phone_number')) {

    function country_code_phone_number($country) {

        $cc = array(
            'BE' => '32',
            'FR' => '33',
            'LU' => '352',
            'NL' => '31',
            'DE' => '49',
            'ES' => '34',
            'GB' => '44',
        );
        return $cc[$country];
    }

}



/**
 * Prepare and format the phone number to be insert in database
 * @param string $number : anything that looks like a number : 081/46.20.34 - 003281462034 - +32 81 46 20 34 - 0499 36 36 36
 * @return string : phone number with its iso code
 */
if (!function_exists('prep_phone_database')) {

    function prep_phone_database($number, $country = "") {
        if (!empty($number)) {
            $number = trim($number);
            $number = preg_replace('/(\/|\.|\s|-)/', '', $number);
            $number = preg_replace('/^00/', '+', $number);
            if (!empty($country) && substr($number, 0, 1) != '+') {
                $number = '+' . country_code_phone_number($country) . substr($number, 1);
            }
        }
        return $number;
    }

}

/**
 * Check if a number is a valid belgian number
 * 
 * @param integer $number
 * @return FALSE or type of phone number
 */
if (!function_exists('valid_be_phone_number')) {

    function valid_be_phone_number($number) {
        $ret = FALSE;
        $number = trim($number);
        if (substr($number, 0, 1) != '0' && substr($number, 0, 1) != '+') {
            $number = '+32' . $number;
        }
        // Patterns
        $pattern = '/^((\+|00)32\s?|0)(\d\s?\d{3}|\d{2}\s?\d{2})(\s?\d{2}){2}$/';
        $pattern_mobile = '/^((\+|00)32\s?|0)4(60|[789]\d)(\s?\d{2}){3}$/';
        // Matches
        if (preg_match($pattern, $number, $matches)) {
            $ret = "fixe";
        } else if (preg_match($pattern_mobile, $number, $matches)) {
            $ret = "mobile";
        }
        return $ret;
    }

}

/**
 * Format a number as a belgian phone number
 * 
 * @param integer $number
 * @param bool $internationnal : show the number in internationnal format : +32 (0) XX XX XX XX
 * @return string : formated phone number or initial string if not a valid format
 */
if (!function_exists('format_be_phone_number')) {

    function format_be_phone_number($number, $internationnal = FALSE) {
        $number = trim($number);
        if (substr($number, 0, 1) != '0') {
            if (substr($number, 0, 1) == '+') {
                $number = str_replace('+32', '', $number);
            }
            $number = '0' . $number;
        }
        $valid_phone_number = valid_be_phone_number($number);
        if ($valid_phone_number !== FALSE) {
            if ($valid_phone_number == 'mobile') {
                $pattern = '/^\s?(\d{4})\s?(\d{2})\s?(\d{2})\s?(\d{2})\s?$/i';
            } else {
                $pattern = '/^(?|(0[2349])\s?(\d{3})|(\d{3})\s?(\d{2}))\s?(\d{2})\s?(\d{2})$/i';
            }
            preg_match($pattern, $number, $matches);
            if ($internationnal) {
                $number = '+32 (0) ' . substr($matches[1], 1) . ' ' . $matches[2] . ' ' . $matches[3] . ' ' . $matches[4];
            } else {
                $number = $matches[1] . ' / ' . $matches[2] . ' ' . $matches[3] . ' ' . $matches[4];
            }
        } else {
            $number = '<span class="ttip badge badge-important" title="Ce n\'est pas un numéro belge valide.">' . $number . '</span>';
        }
        return $number;
    }

}