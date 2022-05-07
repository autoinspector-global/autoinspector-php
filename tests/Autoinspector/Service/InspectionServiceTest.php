<?php

namespace Autoinspector\Service;

use Autoinspector\Stub\CarStub;
use Autoinspector\Stub\ConsumerStub;
use Autoinspector\Stub\InputValuesStub;
use Autoinspector\Stub\ProducerStub;
use Autoinspector\TestHelper;
use DateTime;
use PHPUnit\Framework\TestCase;

final class InspectionServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }

    public function test_list_inspections()
    {

        $inspections =  $this->autoinspector->inspections->list();

        $this->assertIsArray($inspections);
        $this->assertGreaterThan(0, count($inspections));
    }

    public function test_retrieve_inspection()
    {
        $inspections =  $this->autoinspector->inspections->retrieve(
            $_ENV['AUTOINSPECTOR_INSPECTION_ID']
        );

        $this->assertIsArray($inspections);
        $this->assertGreaterThan(0, count($inspections));
    }
}
