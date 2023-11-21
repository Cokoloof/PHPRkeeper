<?php

namespace Tech\Rkeeper\Logger;

interface ILogger{
    public FileLogger $logger;
    public function log(string $message): void;
}