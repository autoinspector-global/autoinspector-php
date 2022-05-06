<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

class MachineryService
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create(array $data)
    {

        $output = Helper::filterInputValues($data['inputValues']);

        $inputValuesNonFiles = $output[Helper::INPUT_VALUES_NON_FILES_KEY];
        $inputValuesFiles = $output[Helper::INPUT_VALUES_FILES_KEY];

        $data['inputValues'] = $inputValuesNonFiles;

        $multipart = Helper::buildMultipartForm($data, $inputValuesFiles);

        return $this->client->post('inspection/machinery', $multipart);
    }

    public function update(array $data)
    {

        $output = Helper::filterInputValues($data['inputValues']);

        $inputValuesNonFiles = $output[Helper::INPUT_VALUES_NON_FILES_KEY];
        $inputValuesFiles = $output[Helper::INPUT_VALUES_FILES_KEY];

        $data['inputValues'] = $inputValuesNonFiles;

        $multipart = Helper::buildMultipartForm($data, $inputValuesFiles);

        return $this->client->put('inspection/machinery/' . $data['productId'], $multipart);
    }
}
