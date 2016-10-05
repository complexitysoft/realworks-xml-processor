<?php

namespace RealworksXmlProcessor\Xml;

class XmlParser
{

    const HOUSES_NESTED_ELEMENT = "WoonObjecten";

    public static function parseToObject($file, $nestedElement = self::HOUSES_NESTED_ELEMENT)
    {
        $fileContents = file_get_contents($file);
        $object = simplexml_load_string($fileContents);

        return $object->$nestedElement;
    }
}