<?php

namespace Tech\Rkeeper\Logger;

abstract class Logger{
    public Logger $logger;
    abstract public function log(string $message): void;
}