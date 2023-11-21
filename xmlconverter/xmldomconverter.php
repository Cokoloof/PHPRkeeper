<?php

namespace Tech\Rkeeper\XmlConverter;

use \Traits\MenuTrait;
use \Traits\OrderTrait;


class XmlDomConverter{
    
    use MenuTrait;
    use OrderTrait;

    public function createDomDocumentObject()
    {
        return new \DomDocument("1.0", "UTF-8");
    }
}