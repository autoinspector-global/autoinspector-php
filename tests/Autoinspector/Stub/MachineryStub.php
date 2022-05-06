<?php

namespace Autoinspector\Stub;

class MachineryStub
{

    static public function getStubCreate()
    {
        return [
            'type' => 'backhoe',
            'color' => 'black'
        ];
    }

    static public function getStubUpdate()
    {
        return [
            'purpose' => 'Agrícola',
            'year' => 2019,
            'make' => 'JOHN DEERE',
            'model' => 'V2'
        ];
    }
}
