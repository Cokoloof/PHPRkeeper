<?php
namespace Tech\Rkeeper\Configurator;

abstract class Configurator {
    private static Configurator $configurator;

    public static function getInstance(): Configurator
    {
        if(!isset(self::$configurator))
        {
            $className = static::class;
            self::$configurator = new $className();
        }
        return self::$configurator;
    }

    abstract public function getValue(string $name): string;
    abstract public function setValue(string $name, string $value): void;
    
    private function __counstruct() { }

}