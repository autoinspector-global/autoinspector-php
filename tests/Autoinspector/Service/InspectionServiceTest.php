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

        $reportRequest =  $this->autoinspector->inspections->createReportRequest(
            '66b3c87dbe66d8a15ffe9aba',
            [
                'callbackURL' => 'https://webhook.site/bcd4342b-31f3-46e9-9b0a-201dca7502e4',
            ]
        );

        print_r($reportRequest);

        $listReportRequest =  $this->autoinspector->inspections->listReportRequests(
            '66b3c87dbe66d8a15ffe9aba'
        );

        print_r($listReportRequest);

        $detailReportRequest =  $this->autoinspector->inspections->retrieveReportRequest(
            '66b3c87dbe66d8a15ffe9aba',
            $reportRequest['_id']
        );

        print_r($detailReportRequest);

        $this->assertTrue(true, true);
    }

    // public function test_list_inspections()
    // {

    //     $inspections =  $this->autoinspector->inspections->list();

    //     $this->assertIsArray($inspections);
    //     $this->assertGreaterThan(0, count($inspections));
    // }

    // public function test_retrieve_inspection()
    // {
    //     $inspections =  $this->autoinspector->inspections->retrieve(
    //         $_ENV['AUTOINSPECTOR_INSPECTION_ID']
    //     );

    //     $this->assertIsArray($inspections);
    //     $this->assertGreaterThan(0, count($inspections));
    // }
}
