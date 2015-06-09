<?php

if (!function_exists('UcFirstAndToLower')) {

    function UcFirstAndToLower($str) {
        return ucfirst(strtolower(trim($str)));
    }

}