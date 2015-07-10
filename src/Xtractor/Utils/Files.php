<?php
namespace Xtractor\Utils;
use Xtractor;

class Files
{
  public static function isValidFilePath($filePath)
  {
    if (!file_exists($filePath)) {
      return FALSE;
    }

    if (is_dir($filePath)) {
      return FALSE;
    }

    return TRUE;
  }

  public static function isValidFileType($filePath)
  {
    $supportedMimeTypes = [
      'application/pdf',
      'image/bmp',
      'image/gif',
      'image/jp2',
      'image/jpeg',
      'image/x-pcx',
      'image/png',
      'image/tiff',
    ];

    if (!self::isValidFilePath($filePath)) {
      throw new Exception('Invalid file path.');
    }

    return (bool) in_array(self::getMimeType($filePath), $supportedMimeTypes);
  }

  public static function getMimeType($filePath)
  {
    if (!self::isValidFilePath($filePath)) {
      throw new Exception('Invalid file path.');
    }

    $infoResource = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($infoResource, $filePath);
    finfo_close($infoResource);

    return $mimeType;
  }
}
