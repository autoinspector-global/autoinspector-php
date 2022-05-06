<?php

namespace Autoinspector\Helper;

class Helper
{

    const INPUT_VALUES_FILES_KEY = 'inputValuesFiles';
    const INPUT_VALUES_NON_FILES_KEY = 'inputValuesNonFiles';

    static function buildMultipartForm(array $data, array $files)
    {


        $filesFields = array_map(function ($element) {
            return [
                "name" => $element["label"],
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

    static function filterInputValues(array $inputValues)
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
