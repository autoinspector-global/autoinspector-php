<?php

namespace Autoinspector\Stub;

use Autoinspector\TestHelper;

class InputValuesStub
{

    use TestHelper;

    static public function getStubCreate()
    {
        return [

            [
                "label" => "ARCHIVO 1",
                "value" => fopen(self::path_join(__DIR__, "../../assets/gopher.png"), 'r'),
            ]
        ];
    }

    static public function getStubUpdate()
    {
        return [
            [
                "label" => "TIPO DE POLIZA",
                "value" => "POLIZA A"
            ],

        ];
    }
}
