<?php

namespace Autoinspector\Helper;

use Autoinspector\TestHelper;
use PHPUnit\Framework\TestCase;

final class HelperTest extends TestCase
{

    use TestHelper;

    private $filetest;

    public function setUp(): void
    {
        $this->filetest = $this->path_join(__DIR__, "../../assets/gopher.png");
    }

    public function test_when_send_any_input_file()
    {
        $output = Helper::filterInputValues(
            [
                [
                    "label" => "FACTURA A",
                    "value" => "testing"
                ]
            ]
        );


        $inputFiles = $output['inputValuesFiles'];
        $inputValues = $output['inputValuesNonFiles'];

        $this->assertIsArray($inputFiles);
        $this->assertCount(0, $inputFiles);

        $this->assertIsArray($inputValues);
        $this->assertCount(1, $inputValues);
    }

    public function test_when_send_an_input_file()
    {


        $output = Helper::filterInputValues(
            [
                [
                    "label" => "TIPO DE POLIZA",
                    "value" => "POLIZA A"
                ],
                [
                    "label" => "FACTURA A",
                    "value" => fopen($this->filetest, "r")
                ]
            ]
        );


        $inputFiles = $output['inputValuesFiles'];
        $inputValues = $output['inputValuesNonFiles'];

        $this->assertIsArray($inputFiles);
        $this->assertCount(1, $inputFiles);

        $this->assertIsArray($inputValues);
        $this->assertCount(1, $inputValues);
    }

    public function test_when_build_multipart_form_without_files()
    {

        $output = Helper::buildMultipartForm(
            [
                "consumer" => [
                    "firstname" => "Luciano alvarez"
                ]
            ],
            []
        );


        $this->assertIsArray($output);
        $this->assertArrayHasKey("multipart", $output);

        $dataJSONField = current(array_filter($output["multipart"], function ($element) {
            return array_key_exists("filename", $element) === False;
        }));

        $this->assertEquals("data", $dataJSONField["name"]);
        $this->assertJson($dataJSONField["contents"]);


        $fileInField = current(array_filter($output["multipart"], function ($element) {
            return array_key_exists("filename", $element);
        }));

        $this->assertFalse($fileInField);
    }

    public function test_when_build_multipart_form_with_files()
    {

        $output = Helper::buildMultipartForm(
            [
                "consumer" => [
                    "firstname" => "Luciano alvarez"
                ]
            ],
            [
                [
                    "label" => "FACTURA A",
                    "value" => fopen($this->filetest, "r")
                ],

                [
                    "label" => "FACTURA A",
                    "value" => fopen($this->filetest, "r")
                ],

            ]
        );


        $this->assertIsArray($output);
        $this->assertArrayHasKey("multipart", $output);

        $dataJSONField = current(array_filter($output["multipart"], function ($element) {
            return array_key_exists("filename", $element) === False;
        }));

        $this->assertEquals("data", $dataJSONField["name"]);
        $this->assertJson($dataJSONField["contents"]);


        $fileInField = current(array_filter($output["multipart"], function ($element) {
            return array_key_exists("filename", $element);
        }));


        $this->assertIsArray($fileInField);
    }
}
