<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

class CustomService
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($data)
    {
        return Helper::requestWrapper(function () use ($data) {
            return $this->client->post('inspection/custom', [
                'json' => $data
            ]);
        });
    }
}
