<?php


namespace Autoinspector\Stub;

class GoodsStub
{

    static public function getStubCreate()
    {

        return [
            [
                "category" => 'electronics',
                "type" => 'camera',
                "make" => 'GO PRO',
                "model" => 'PRO',
                "price" => '14400',
                "serialNumber" => 'A23r',
            ]
        ];
    }
}
