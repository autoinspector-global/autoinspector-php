<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;
use PHPUnit\TextUI\Help;

class ImageService
{

    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function upload($input)
    {

        $image = $input['image'];

        unset($input['image']);

        return Helper::requestWrapper(function () use ($input, $image) {
            return $this->client->post('inspection/image/' . $input['productId'], [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => $image,
                        'filename' => basename(stream_get_meta_data($image)["uri"])
                    ],
                    [
                        'name' => 'data',
                        'contents' => json_encode($input),
                    ],
                ]
            ]);
        });
    }

    public function generateToken()
    {
        return Helper::requestWrapper(function () {
            return $this->client->post('inspection/image/token', []);
        });
    }
}
