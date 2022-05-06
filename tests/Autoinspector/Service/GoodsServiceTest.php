<?php

namespace Autoinspector\Service;

use Autoinspector\Stub\ConsumerStub;
use Autoinspector\Stub\GoodsStub;
use Autoinspector\Stub\InputValuesStub;
use Autoinspector\Stub\ProducerStub;
use Autoinspector\TestHelper;
use PHPUnit\Framework\TestCase;

final class GoodsServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }

    private function createInspection()
    {
        $response =  $this->autoinspector->inspections->goods->create([
            'consumer' => ConsumerStub::getStubCreate(),
            'inputValues' => InputValuesStub::getStubCreate(),
            'goods' => GoodsStub::getStubCreate(),
            'templateId' => $_ENV['AUTOINSPECTOR_GOODS_TEMPLATE_ID'],
            'producer'  => ProducerStub::getStub(),
            'initialStatus' => 'started'
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $jsonResponse = json_decode($response->getBody()->getContents(), true);

        $expectedKeys = ['inspectionId', 'productIds', 'message'];

        foreach ($expectedKeys as $expectedKey) {
            $this->assertTrue(array_key_exists($expectedKey, $jsonResponse));

            if ($expectedKey == "productIds") {
                $this->assertIsArray($jsonResponse[$expectedKey]);
            }
        }

        return $jsonResponse;
    }

    public function test_create_goods_inspection()
    {

        $this->createInspection();
    }
}
