<?php

namespace Autoinspector\Service;

use Autoinspector\Stub\ConsumerStub;
use Autoinspector\Stub\InputValuesStub;
use Autoinspector\Stub\ProducerStub;
use Autoinspector\TestHelper;
use PHPUnit\Framework\TestCase;

final class PeopleServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }

    private function createInspection()
    {
        $response =  $this->autoinspector->inspections->people->create([
            'consumer' => ConsumerStub::getStubCreate(),
            'inputValues' => InputValuesStub::getStubCreate(),
            'templateId' => $_ENV["AUTOINSPECTOR_PEOPLE_TEMPLATE_ID"],
            'producer'  => ProducerStub::getStub(),
            'initialStatus' => 'started'
        ]);


        $expectedKeys = ['inspectionId', 'productId', 'message'];

        foreach ($expectedKeys as $expectedKey) {
            $this->assertTrue(array_key_exists($expectedKey, $response));
        }

        return $response;
    }

    public function test_create_people_inspection()
    {

        $this->createInspection();
    }
}
