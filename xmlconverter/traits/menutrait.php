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
        $command = $this->generateDomObjectWithHeader();
        $command->setAttribute("CMD","GetRefData");
        $command->setAttribute("RefName","MenuItems");
        $command->setAttribute("OnlyActive","1");

        return $this->saveXml($command);
    }
}