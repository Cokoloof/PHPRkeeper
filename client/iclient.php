<?php

namespace Tech\Rkeeper\Client;

interface IClient{
    public function sendRequest(string $xmlBody): string;
}