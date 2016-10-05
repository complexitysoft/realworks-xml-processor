<?php

namespace RealworksXmlProcessor\Http;

use RealworksXmlProcessor\Realworks;
use RealworksXmlProcessor\Xml\XmlParser;
use RealworksXmlProcessor\Zip\Unarchiver;

class Fetcher
{

    const LINK                  = "CONNECTED_PARTNER";

    const HOUSES_OG             = "WONEN";

    const VGM_UNIT_OG           = "VGMUNITS";

    const BOG_OG                = "BOG";

    const HOUSES_FILE_PREFIX    = "WONEN_";

    protected $realworks;

    protected $parameters;

    public function __construct(Realworks $realworks)
    {
        $this->realworks = $realworks;
    }

    public function houses()
    {
        // Set parameters
        $this->parameters['koppeling']  = self::LINK;
        $this->parameters['user']       = $this->realworks->getUsername();
        $this->parameters['password']   = $this->realworks->getPassword();
        $this->parameters['og']         = self::HOUSES_OG;
        $this->parameters['kantoor']    = $this->realworks->getOffice();

        // Set URL variables
        $endpoint       = $this->realworks->getEndpoint();
        $queryString    = http_build_query($this->parameters);
        $url            = $endpoint . '?' . $queryString;

        var_dump($url);

        file_put_contents('temp.zip', fopen($url, 'r'));

        Unarchiver::unzip('temp.zip');

        $fileName = self::HOUSES_FILE_PREFIX . Date('Ymd') . '.xml';
        $parsed = XmlParser::parseToObject('./temp/' . $fileName);

        $this->cleanUp();

        return $parsed;
    }

    private function cleanUp()
    {
        chmod('./temp', 777);
        chmod('./temp.zip', 777);
        chmod('./temp/__MACOSX', 777);

        unlink('./temp.zip');
        $this->deleteDir('./temp');
    }

    private function deleteDir($dirname) {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                else
                    $this->deleteDir($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
}