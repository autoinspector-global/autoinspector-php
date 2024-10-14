<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

class MotoService
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($data)
    {
        return Helper::requestWrapper(function () use ($data) {
            return $this->client->post('inspection/moto', [
                'json' => $data
            ]);
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
            return $this->client->put('inspection/moto/' . $data['productId'], $multipart);
        });
    }
}
