<?php

namespace Autoinspector\Services;


class InspectionService
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function hello()
    {
        $request = new \GuzzleHttp\Psr7\Request('GET', '/');
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            echo 'I completed! ' . $response->getBody();
        });
        $promise->wait();
    }
}
