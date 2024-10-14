<?php

namespace Autoinspector\Service;

use Autoinspector\TestHelper;
use PHPUnit\Framework\TestCase;

final class CellphoneServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }


    public function test_inspections()
    {

        $inspection = $this->autoinspector->inspections->cellphone->create([
            'locale' => 'es_AR',
            'initialStatus' => 'started',
            'templateId' => '670d233e907ecf9f2f4eb2ae',
            'producer' => [
                'internalId' => '123'
            ],
            'consumer' => [
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'john_doe@gmail.com',
                'identification' => '3213232'
            ],
            'delivery' => [
                'disabled' => false,
                'channel' => 'wsp',
                'destination' => '3815555620',
                'countryISO' => 'AR'
            ],
            'cellphone' => [
                'make' => 'Apple',
                'model' => 'iPhone X'
            ]
        ]);
        
    
        print_r($inspection);

        $updated = $this->autoinspector->inspections->cellphone->update([
            'productId' => $inspection['productId'],
            'cellphone' => [
                'serialNumber' => 'IMEI1235',
                'price' => 778259
            ]
        ]);

        print_r($updated);

        $this->assertTrue(true, true);

        $inspections = $this->autoinspector->inspections->list(
            [
                "limit" => 10,
                "page" => 1
            ]
        );

        print_r($inspections);
    }
    
}
