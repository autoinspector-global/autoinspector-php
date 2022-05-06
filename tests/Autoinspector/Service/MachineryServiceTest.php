<?php

namespace Autoinspector\Service;

use Autoinspector\Stub\ConsumerStub;
use Autoinspector\Stub\InputValuesStub;
use Autoinspector\Stub\MachineryStub;
use Autoinspector\Stub\ProducerStub;
use Autoinspector\TestHelper;
use PHPUnit\Framework\TestCase;

final class MachineryServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }

    private function createInspection()
    {
        $response =  $this->autoinspector->inspections->machinery->create([
            'consumer' => ConsumerStub::getStubCreate(),
            'inputValues' => InputValuesStub::getStubCreate(),
            'machinery' => MachineryStub::getStubCreate(),
            'templateId' => $_ENV["AUTOINSPECTOR_MACHINERY_TEMPLATE_ID"],
            'producer'  => ProducerStub::getStub(),
            'initialStatus' => 'started'
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $jsonResponse = json_decode($response->getBody()->getContents(), true);

        $expectedKeys = ['inspectionId', 'productId', 'message'];

        foreach ($expectedKeys as $expectedKey) {
            $this->assertTrue(array_key_exists($expectedKey, $jsonResponse));
        }

        return $jsonResponse;
    }

    public function test_create_machinery_inspection()
    {

        $this->createInspection();
    }

    public function test_update_inspection()
    {

        $inspection = $this->createInspection();

        $response =  $this->autoinspector->inspections->machinery->update([
            'productId' => $inspection['productId'],
            'machinery' => MachineryStub::getStubUpdate(),
            'inputValues' => InputValuesStub::getStubUpdate(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $jsonResponse = json_decode($response->getBody()->getContents());

        $this->assertTrue(array_key_exists('message', $jsonResponse));
    }
}
