<?php

namespace Autoinspector\Service;


class ImageService
{

    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function upload(array $input)
    {
        return $this->client->post('inspection/image/' . $input['productId'], [
            'multipart' => [
                [
                    'name' => 'side',
                    'contents' => $input['side'],
                ],
                [
                    'name' => 'image',
                    'contents' => $input['image'],
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
        return $this->client->post('/inspection/image/token', []);
    }
}
