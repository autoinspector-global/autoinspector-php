<?php

namespace Autoinspector\Service;

use Autoinspector\Stub\CarStub;
use Autoinspector\Stub\ConsumerStub;
use Autoinspector\Stub\InputValuesStub;
use Autoinspector\Stub\ProducerStub;
use Autoinspector\TestHelper;
use DateTime;
use PHPUnit\Framework\TestCase;

final class ImageServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }

    public function test_upload_image()
    {

        $inspection =  $this->autoinspector->inspections->car->create([
            'consumer' => array_merge(ConsumerStub::getStubCreate(), ConsumerStub::getStubUpdate()),
            'inputValues' => InputValuesStub::getStubUpdate(),
            'car' => array_merge(CarStub::getStubCreate(), CarStub::getStubUpdate()),
            'templateId' => $_ENV["AUTOINSPECTOR_CAR_TEMPLATE_ID"],
            'producer'  => ProducerStub::getStub(),
            'initialStatus' => 'started',
        ]);

        print_r($inspection, false);

        $date = new DateTime();

        $response =  $this->autoinspector->images->upload([
            'coordinates' => [
                'latitude' => 20,
                'longitude' => 10,
            ],
            'date' =>  $date->format('c'),
            'side' => 'back',
            'image' => fopen(self::path_join(__DIR__, "../../assets/gopher.png"), 'r'),
            'productId' => $inspection['productId']
        ]);

        $this->assertArrayHasKey('message', $response);
    }

    public function test_generate_image_token()
    {
        $response =  $this->autoinspector->images->generateToken();
        $this->assertArrayHasKey('token', $response);
        $this->assertIsString($response['token']);
    }
}
