<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

class GoodsService
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($data)
    {

        $body = json_encode($data);

        return Helper::requestWrapper(function () use ($body) {
            return $this->client->post('inspection/goods', $body);
        });
    }
}
