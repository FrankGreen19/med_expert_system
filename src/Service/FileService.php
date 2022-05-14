<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\File;
use function Sodium\randombytes_uniform;

class FileService
{
    public static function upload(File $file): File
    {
        //@todo validation
        $name = self::generateRandomString() . '.jpg';
        return $file->move($_ENV['FILE_UPLOAD_DIR'], $name);
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}