<?php

namespace RealworksXmlProcessor\Zip;

class Unarchiver
{
    public static function getCompressedFileContents($zipArchive, $filePath)
    {
        $path = sprintf("zip://%s#%s", $zipArchive, $filePath);
        
        return file_get_contents($path);
    }
}