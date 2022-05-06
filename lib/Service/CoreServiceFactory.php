<?php

namespace Autoinspector\Services;

class CoreServiceFactory
{

    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    private static $classMaps = [
        "inspections" => InspectionService::class,
    ];

    public function __get($name)
    {
        return array_key_exists($name, self::$classMaps) ? new self::$classMaps[$name]($this->client) : null;
    }
}
