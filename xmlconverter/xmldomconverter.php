<?php

namespace Tech\Rkeeper\XmlConverter;

use Tech\Rkeeper\XmlConverter\Traits\MenuTrait;
use Tech\Rkeeper\XmlConverter\Traits\OrderTrait;


class XmlDomConverter{
    
    use MenuTrait;
    use OrderTrait;

    public function generateDomObjectWithHeader()
    {
        $xmlBody = $this->createDomDocumentObject();
        $query = $xmlBody->createElement("RK7Query");
        $query = $xmlBody->appendChild($query);
        $command = $xmlBody->createElement("RK7CMD");
        $command = $query->appendChild($command);
        return $command;
    }
    
    public function createDomDocumentObject()
    {
        return new \DomDocument("1.0", "UTF-8");
    }

    public function saveXml($node)
    {
        return $node->ownerDocument->saveXML();
    }
}