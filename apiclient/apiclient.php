<?

namespace Tech\Rkeeper\ApiClient;

use Tech\Rkeeper\Services\Menuservice;
use Tech\Rkeeper\Services\OrderService;

class ApiClient extends BaseApiClient{
    public function order(): OrderService
    {
        return new OrderService($this->client, $this->converter);
    }

    public function menu(): MenuService
    {
        return new MenuService($this->client, $this->converter);
    }
}