<?php

namespace Autoinspector\Service;


class TemplateService
{

    private $client;


    public function __construct($client)
    {
        $this->client = $client;
    }

    public function list(
        $params = []
    ) {
        return $this->client->get('inspection/template/list', [
            'query' => $params
        ]);
    }
}
