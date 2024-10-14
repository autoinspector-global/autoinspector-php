<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

class PeopleService
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($data)
    {
        return Helper::requestWrapper(function () use ($data) {
            return $this->client->post('inspection/people', [
                'json' => $data
            ]);
        });
    }
}
