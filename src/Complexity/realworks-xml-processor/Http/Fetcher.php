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

    const HOUSES_NESTED_ELEMENT = "WoonObjecten";

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

        file_put_contents('temp.zip', fopen($url, 'r'));

        $fileName = self::HOUSES_FILE_PREFIX . Date('Ymd') . '.xml';
        $xml = Unarchiver::getCompressedFileContents('temp.zip', $fileName);

        $parsed = simplexml_load_string($xml);

        $this->cleanUp();

        return $parsed;
    }

    private function cleanUp()
    {
        chmod('./temp.zip', 777);
        unlink('./temp.zip');
    }
}