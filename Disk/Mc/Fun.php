<?php
/**
 * Created by PhpStorm.
 * User: 123456
 * Date: 2015/5/19
 * Time: 11:22
 */


if (!function_exists('args')) {
    function args($key = null) {
        return MpInput::parameters($key);
    }
}
if (!function_exists('xss_clean')) {
    function xss_clean($val) {
        return MpInput::xss_clean($val);
    }
}