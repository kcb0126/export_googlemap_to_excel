<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/3/2018
 * Time: 4:19 AM
 */

/**
 *
 * @param array $array
 * @param string $key
 * @return string
 */
function getMember($array = [], $key = "") {
    if(array_key_exists($key, $array)) {
        return $array[$key];
    } else {
        return "-";
    }
}

/**
 *
 * @param int $length
 * @return string
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
