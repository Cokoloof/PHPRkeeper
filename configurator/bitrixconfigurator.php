<?php
namespace Tech\Rkeeper\Configurator;
use Tech\Rkeeper\Configurator\Configurator;
use \Bitrix\Main\Config\Option;

class BitrixConfigurator extends Configurator{
    public function getValue(string $name): string
    {
        return Option::Get(RKEEPER_MODULE_ID, $name);
    }

    public function setValue(string $name, string $value): void
    {
        return Option::Set(RKEEPER_MODULE_ID, $name, $value);
    }
}