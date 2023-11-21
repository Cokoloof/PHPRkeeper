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

    public function getMenuXmlRequest($categoryName = ""): string
    {
        $command = $this->generateDomObjectWithHeader();
        $command->setAttribute("CMD","GetRefData");
        $command->setAttribute("RefName","MenuItems");
        $command->setAttribute("OnlyActive","1");
        //Если задано имя категории блюд, блюда будут фильтроваться по нему
        if(!empty($categoryName))
        {
            $propFilters = $command->createElement("PROPFILTERS");
            $propFilter = $command->createElement("PROPFILTER");
            $propFilterInner = $command->createElement("PROPFILTER");
            $propFilterInner->setAttribute("Name", "CategPath");
            $propFilterInner->setAttribute("Value", $categoryName);
            //Разрешение использования регулярных выражений в Value
            $propFilterInner->setAttribute("Masked", "1");
            $propFilterInner = $propFilter->appendChild($propFilterInner);
            $propFilter = $propFilters->appendChild($propFilter);
            $propFilters = $command->appendChild($propFilters);
        }
        return $this->saveXml($command);
    }
}