<?php

if (!function_exists('form_error')) {

    function form_error($field = '', $prefix = '', $suffix = '') {
        if (FALSE === ($OBJ = & _get_validation_object())) {
            return '';
        }

        if (is_array($field)) {
            $array_field = $field;
            $field = $array_field[0];
            for ($i = 1; $i < count($array_field); $i++) {
                $field .= '[' . $array_field[$i] . ']';
            }
            return form_error($field, $prefix = '', $suffix = '');
        }
        return $OBJ->error($field, $prefix, $suffix);
    }

}
