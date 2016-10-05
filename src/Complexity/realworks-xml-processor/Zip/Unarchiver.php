<?php

namespace RealworksXmlProcessor\Zip;

use ZipArchive;

class Unarchiver
{
    public static function unzip($file, $destination = './temp')
    {
        $zip = new ZipArchive();

        if ($zip->open($file))
        {
            $zip->extractTo($destination);
        }
    }

    /**
     * @return \ZipArchive
     */
    public static function getZip()
    {
        return Unarchiver::$zip;
    }
}