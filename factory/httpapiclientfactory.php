<?php

namespace Tech\Rkeeper\Factory;
use \Tech\Rkeeper\Client\HttpClient;
use \Tech\Rkeeper\Client\IClient;
use \Tech\Rkeeper\XmlConverter\XmlDomConverter;
class HttpApiClientFactory extends ApiClientFactory{
    public function createClient(): IClient
    {
        return new HttpClient(
            $this->configurator->getValue("username"),
            $this->configurator->getValue("password"),
            $this->configurator->getValue("rkeeperAddress")
        );
    }

    public function createConverter(): XmlDomConverter
    {
        return new XmlDomConverter;
    }
}