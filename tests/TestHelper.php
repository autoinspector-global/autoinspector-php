<?php

namespace Autoinspector;

use Autoinspector\AutoinspectorClient;
use Dotenv\Dotenv;

trait TestHelper
{
    static public function setupSDK()
    {

        $envFile =  self::path_join(__DIR__, "../");
        $dotenv = Dotenv::createImmutable($envFile);
        $dotenv->load();

        $autoinspector = new AutoinspectorClient($_ENV['AUTOINSPECTOR_API_KEY']);

        return $autoinspector;
    }

    static public function path_join($base, $path)
    {
        if (self::path_is_absolute($path)) {
            return $path;
        }

        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    static function path_is_absolute($path)
    {
        if (self::wp_is_stream($path) && (is_dir($path) || is_file($path))) {
            return true;
        }
    }

    static public function wp_is_stream($path)
    {
        $scheme_separator = strpos($path, '://');

        if (false === $scheme_separator) {
            // $path isn't a stream.
            return false;
        }

        $stream = substr($path, 0, $scheme_separator);
    }
}
