<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

class BikeService
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
            return $this->client->post('inspection/bike', $body);
        });
    }

    public function update($data)
    {

        $output = Helper::filterInputValues($data['inputs']);

        $inputValuesNonFiles = $output[Helper::INPUT_VALUES_NON_FILES_KEY];
        $inputValuesFiles = $output[Helper::INPUT_VALUES_FILES_KEY];

        $data['inputs'] = $inputValuesNonFiles;

        $multipart = Helper::buildMultipartForm($data, $inputValuesFiles);

        return Helper::requestWrapper(function () use ($multipart, $data) {
            return $this->client->put('inspection/bike/' . $data['productId'], $multipart);
        });
    }
}
