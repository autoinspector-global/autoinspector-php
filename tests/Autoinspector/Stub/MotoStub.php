<?php


namespace Autoinspector\Stub;

class MotoStub
{

    static public function getStubCreate()
    {
        return [
            'plate' => 'AB705SU',
            'year' => 2020
        ];
    }

    static public function getStubUpdate()
    {
        return [
            'color' => 'black',
            'make' => 'JEEP',
            'model' => 'RENEGADE'
        ];
    }
}
