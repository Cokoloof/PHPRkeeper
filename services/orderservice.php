<?
namespace Tech\Rkeeper\Services;

class OrderService extends BaseService{
    public function add($orderFields): string
    {
        $xmlBody = $this->converter->setOrderParamsToCreateOrderXml($orderFields);
        $response = $this->client->sendRequest($xmlBody);
        return $this->converter->getOrderGuid($response);
    }

    public function update($guid, $orderFields): void
    {
        $xmlBody = $this->converter->setOrderParamsToUpdateOrderXml($orderFields);
        $this->client->sendRequest($xmlBody);
    }
}