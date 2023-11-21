<?php

namespace Tech\Rkeeper\Factory;
use \Tech\Rkeeper\Client\IClient;
use \Tech\Rkeeper\XmlConverter\XmlDomConverter;
use Tech\Rkeeper\Configurator\Configurator;

abstract class ApiClientFactory{
    public Configurator $configurator;

    public function __conctruct(Configurator $configurator)
    {
        $this->configurator = $configurator;
    }
    abstract public function createClient(): IClient;

    abstract public function createConverter(): XmlDomConverter;    
}