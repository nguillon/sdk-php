<?php

class Xtractor_Utils_Url
{
  public static function isValidUrl($url)
  {
    $url = trim($url);

    if (empty($url)) {
      return FALSE;
    }

    if(!filter_var($url, FILTER_VALIDATE_URL)) {
      return FALSE;
    }

    return TRUE;
  }
}
