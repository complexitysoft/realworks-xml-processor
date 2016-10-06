<?php

namespace RealworksXmlProcessor\Zip;

class Unarchiver
{
    public static function getCompressedFileContents($zipArchive, $fileName)
    {
        $path = sprintf("zip://%s#%s", $zipArchive, $fileName);
        
        return file_get_contents($path);
    }
}