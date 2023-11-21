<?php

namespace Tech\Rkeeper\XmlConverter\Traits;

trait MenuTrait {
    public function getMenuArrayFromXml(string $xmlString): Array
    {
        $menuArray = [];
        $xmlObject = $this->createDomDocumentObject();
        $xmlObject->loadXml($xmlString);
        $menuItems = $xmlObject->getElementsByTagName("Item");
        foreach($menuItems as $menuItem)
        {
            $menuArray[] = [
                $menuItem->getAttribute("ItemIdent"),
                $menuItem->getAttribute("GUIDString"),
                $menuItem->getAttribute("Name"),
                
            ];
        }
        return $menuArray;
    }

    public function getMenuXmlRequest(): string
    {
        $xmlBody = $this->createDomDocumentObject();
        $query = $xmlBody->createElement("RK7Query");
        $query = $xmlBody->appendChild($query);

        $command = $xmlBody->createElement("RK7CMD");
        $command->setAttribute("CMD","GetRefData");
        $command->setAttribute("RefName","MenuItems");
        $command->setAttribute("OnlyActive","1");
        $command = $query->appendChild($command);

        return $xmlBody->saveXml();
    }
}