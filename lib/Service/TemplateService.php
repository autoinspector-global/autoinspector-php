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
            return $this->client->get('inspection/template', [
                'query' => $params
            ]);
        });
    }

    public function retrieve(
        $templateId
    ) {
        return Helper::requestWrapper(function () use ($templateId) {
            return $this->client->get('inspection/template/' . $templateId );
        });
    }
}
