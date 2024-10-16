<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;
use Autoinspector\Service\CarService;
use Autoinspector\Service\MotoService;
use Autoinspector\Service\MachineryService;
use Autoinspector\Service\GoodsService;
use Autoinspector\Service\PeopleService;
use Autoinspector\Service\CustomService;
use Autoinspector\Service\BikeService;
use Autoinspector\Service\CellphoneService;

class InspectionService
{

    private $client;
    private static $classMaps = [
        'car' => CarService::class,
        'moto' => MotoService::class,
        'machinery' => MachineryService::class,
        'goods' => GoodsService::class,
        'people' => PeopleService::class,
        'custom' => CustomService::class,
        'bike' => BikeService::class,
        'cellphone' => CellphoneService::class
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
                'json' => $update
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

    public function createReportRequest($inspectionId, $update)
    {
        return Helper::requestWrapper(function () use ($inspectionId, $update) {
            return $this->client->post('inspection/' . $inspectionId . '/report/request', [
                'json' => $update,
            ]);
        });
    }

    public function listReportRequests($inspectionId)
    {
        return Helper::requestWrapper(function () use ($inspectionId) {
            return $this->client->get('inspection/' . $inspectionId . '/report/request', []);
        });
    }

    public function retrieveReportRequest($inspectionId, $reportRequestId)
    {
        return Helper::requestWrapper(function () use ($inspectionId, $reportRequestId) {
            return $this->client->get('inspection/' . $inspectionId . '/report/request/' . $reportRequestId, []);
        });
    }
}
