<?php

/**
 * @param $password
 * @return string
 */
function validatePassword ($password): string {
    $uc = preg_match('@[A-Z]@', $password);
    $lc = preg_match('@[a-z]@', $password);
    $num = preg_match('@[0-9]@', $password);
    $specChars = $lc = preg_match('@[^\w]@', $password);
    $len = strlen($password) >= 7 && strlen($password) <= 20;

    if($uc && $lc && $num && $specChars && $len) {
        return true;
    }
    return false;
}