<?php

namespace Tech\Rkeeper\ApiClient;
use Tech\Rkeeper\Factory\ApiClientFactory;
use Tech\Rkeeper\XmlConverter\XmlDomConverter;
use Tech\Rkeeper\Client\IClient;
use Tech\Rkeeper\Configurator\Configurator;
use Tech\Rkeeper\Logger\Logger;


abstract class ApiClient{

    protected XmlDomConverter $converter;
    protected IClient $client;        
    protected Configurator $configurator;
    protected Logger $logger;

    public function __construct(ApiClientFactory $factory, Configurator $configurator, Logger $logger = null)
    {
        $this->converter = $factory->createConverter();
        $this->client = $factory->createClient();
        $this->configurator = $configurator;
        $this->logger = $logger;
    }
}