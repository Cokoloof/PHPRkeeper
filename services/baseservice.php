<?
namespace Tech\Rkeeper\Services;
use Tech\Rkeeper\Client\IClient;
use Tech\Rkeeper\XmlConverter\XmlDomConverter;

abstract class BaseService{
    protected IClient $client;
    protected XmlDomConverter $converter;
    public function __construct($client, $converter)
    {
        $this->client = $client;
        $this->converter = $converter;
    }
}