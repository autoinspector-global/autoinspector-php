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
            'consumer' => ConsumerStub::getStubCreate(),
            'inputValues' => InputValuesStub::getStubCreate(),
            'car' => CarStub::getStubCreate(),
            'templateId' => $_ENV["AUTOINSPECTOR_CAR_TEMPLATE_ID"],
            'producer'  => ProducerStub::getStub(),
            'initialStatus' => 'started',
        ]);

        $inspection = json_decode($inspection->getBody()->getContents(), true);

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
    }

    public function test_generate_image_token()
    {
        $token =  $this->autoinspector->images->generateToken();

        $this->assertIsString($token);
    }
}
