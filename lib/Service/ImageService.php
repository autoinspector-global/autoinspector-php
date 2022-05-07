<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;

class ImageService
{

    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function upload(array $input)
    {

        if (array_key_exists("coordinates", $input)) {
            $input["coordinates"] = json_encode($input["coordinates"]);
        }

        return $this->client->post('inspection/image/' . $input['productId'], [
            'multipart' => [
                [
                    'name' => 'side',
                    'contents' => $input['side'],
                ],
                [
                    'name' => 'image',
                    'contents' => $input['image'],
                    'filename' => basename(stream_get_meta_data($input['image'])["uri"])
                ],
                [
                    'name' => 'coordinates',
                    'contents' => $input['coordinates'],
                ],
                [
                    'name' => 'date',
                    'contents' => $input['date'],
                ]
            ]
        ]);
    }

    public function generateToken()
    {
        return Helper::requestWrapper(function () {
            return $this->client->post('/inspection/image/token', []);
        });
    }
}
