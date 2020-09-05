<?php

if (!function_exists('webpFileName')) {

    /**
     * @param $filename
     * @return string
     * @author Adam Ondrejkovic
     */
    function webpFileName($filename)
    {
        return explode(".", $filename)[0] . ".webp";
    }
}

