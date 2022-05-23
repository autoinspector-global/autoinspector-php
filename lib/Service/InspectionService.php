<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;
use Autoinspector\Service\CarService;
use Autoinspector\Service\MotoService;

class InspectionService
{

    private $client;
    private static $classMaps = [
        'car' => CarService::class,
        'moto' => MotoService::class,
        'machinery' => MachineryService::class,
        'goods' => GoodsService::class,
        'people' => PeopleService::class,
        'custom' => CustomService::class
    ];

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($name)
    {
        return array_key_exists($name, self::$classMaps) ? new self::$classMaps[$name]($this->client) : null;
    }

    public function finish($inspectionId)
    {
        return Helper::requestWrapper(function () use ($inspectionId) {
            return $this->client->post('inspection/finish/' . $inspectionId, []);
        });
    }

    public function update($inspectionId, $update)
    {
        return Helper::requestWrapper(function () use ($inspectionId, $update) {
            return $this->client->put('inspection/' . $inspectionId, [
                'body' => $update
            ]);
        });
    }

    public function retrieve($inspectionId)
    {
        return Helper::requestWrapper(function () use ($inspectionId) {
            return $this->client->get('inspection/' . $inspectionId, []);
        });
    }

    public function list($params = [])
    {
        return Helper::requestWrapper(function () use ($params) {
            return $this->client->get('inspection/', [
                'query' => $params,
            ]);
        });
    }
}
