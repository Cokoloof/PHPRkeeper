<?
namespace Tech\Rkeeper\Services;

class Menuservice extends BaseService {
    public function get()
    {
        $xmlBody = $this->converter->getMenuXmlRequest();
        $menu = $this->client->sendRequest($xmlBody);
        return $this->converter->getMenuArrayFromXml($menu);
    }
}