<?php
namespace Xtractor\Utils;

class Url
{
    public static function isValidUrl($url)
    {
        $url = trim($url);

        if (empty($url)) {
            return false;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;
    }
}
