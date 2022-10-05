<?php

namespace Autoinspector\Helper;

use PhpParser\Node\Stmt\TryCatch;

class Helper
{

    const INPUT_VALUES_FILES_KEY = 'inputValuesFiles';
    const INPUT_VALUES_NON_FILES_KEY = 'inputValuesNonFiles';

    static function requestWrapper($requester)
    {

        try {
            $response = $requester();
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    static function buildMultipartForm($data, $files)
    {

        $filesFields = array_map(function ($element) {
            return [
                "name" => $element["identifier"],
                "contents" => $element["value"],
                "filename" => basename(stream_get_meta_data($element["value"])["uri"])
            ];
        }, $files);


        return [
            'multipart' => [
                ...$filesFields,
                [
                    'name' => 'data',
                    'contents' => json_encode($data),
                ]
            ]
        ];
    }

    static function buildBody($data)
    {
        return json_encode($data);
    }

    static function filterInputValues($inputValues)
    {

        $inputValuesFiles = [];
        $inputValuesNonFiles = [];

        foreach ($inputValues as $inputValue) {

            if (is_resource($inputValue["value"])) {
                array_push($inputValuesFiles, $inputValue);
                continue;
            }

            array_push($inputValuesNonFiles, $inputValue);
        }

        return [
            self::INPUT_VALUES_FILES_KEY => $inputValuesFiles,
            self::INPUT_VALUES_NON_FILES_KEY => $inputValuesNonFiles
        ];
    }
}
