<?php

namespace Tech\Rkeeper\ApiClient;
use Tech\Rkeeper\Factory\IntegrationFactory;
use Tech\Rkeeper\XmlConverter\XmlDomConverter;
use Tech\Rkeeper\Client\IClient;
use Tech\Rkeeper\Configurator\Configurator;
use Tech\Rkeeper\Logger\ILogger;


abstract class ApiClient{

    protected XmlDomConverter $converter;
    protected IClient $client;        
    protected Configurator $configurator;
    protected ILogger $logger;

    public function __construct(IntegrationFactory $factory, Configurator $configurator, ILogger $logger = null)
    {
        $this->converter = $factory->createConverter();
        $this->client = $factory->createClient();
        $this->configurator = $configurator;
        $this->logger = $logger;
    }
}