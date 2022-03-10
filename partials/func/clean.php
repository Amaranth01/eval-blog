<?php

/**
 * @param String $data
 * @return string
 */
function clean(string $data): string{

        $data = trim($data);
        $data = strip_tags($data);
        $data = htmlentities($data);

        if ($data < 0 || $data > 100) {
            $data = 15;
        }

        return $data;
}