<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

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
        return Helper::requestWrapper(function () use ($params) {
            return $this->client->get('inspection/template/list', [
                'query' => $params
            ]);
        });
    }
}
