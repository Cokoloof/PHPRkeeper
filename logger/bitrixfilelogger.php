<?php

namespace Tech\Rkeeper\Logger;

use Bitrix\Main\Diag\FileLogger;

class BitrixFileLogger implements ILogger
{
    public function __construct($fileName, $fileMaxSize)
    {
        $this->logger = new FileLogger($fileName, $fileMaxSize);
    }

    public function log(string $message): void
    {
        $this->logger->debug($message);
    }
}