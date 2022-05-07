<?php

namespace Autoinspector\Stub;

use DateTime;

class ConsumerStub
{

    static public function getStubCreate()
    {
        return [
            'firstName' => 'Luciano',
            'lastName' => 'Alvarez',
            'email' => 'lucianoalvarez1212@gmail.com',
            'identification' => '3213232',
        ];
    }

    static public function getStubUpdate()
    {


        return [
            'firstName' => 'Luciano',
            'lastName' => 'Alvarez',
            'email' => 'lucianoalvarez1212@gmail.com',
            'identification' => '3213232',
            'state' => 'Buenos Aires',
            'country' => 'Argentina',
            'city' => 'Testing',
            'sex' => 0,
            'birthdate' => "2022-01-05",
            'address' => 'Lopez y Planes 528',
            'phone' => '3813635420'
        ];
    }
}
