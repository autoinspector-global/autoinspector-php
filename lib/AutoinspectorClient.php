<?php

namespace Autoinspector;


use Autoinspector\Services\CoreServiceFactory;
use Error;
use GuzzleHttp;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;


function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

class AutoinspectorClient
{

    const VERSION = 'v1';

    private $configuration;
    private $coreServiceFactory;
    private $httpClient;

    public function __construct($config = [])
    {

        if (is_string($config)) {
            $config = ['api_key' => $config];
        } elseif (!is_array($config)) {
            throw new Error('$config must be a string or array');
        }


        $config = array_merge($this->getDefaultConfiguration(), $config);


        $this->configuration = $config;

        $handler = HandlerStack::create();

        $handler->push(Middleware::mapRequest(function (RequestInterface $request) {
            $request->withHeader('x-api-key', $this->configuration['api_key']);
            $request->withHeader('User-Agent', "autoinspector-php-sdk/" . self::VERSION);
            return $request;
        }));


        $this->httpClient = new GuzzleHttp\Client([
            'base_uri' => $this->configuration['base_url'],
            'timeout' => $this->configuration['timeout'],
        ]);
    }


    public function __get($name)
    {

        if (null == $this->coreServiceFactory) {
            $this->coreServiceFactory = new CoreServiceFactory($this->httpClient);
        }

        return $this->coreServiceFactory->__get($name);
    }

    public function getDefaultConfiguration()
    {

        return [
            'api_key' => null,
            'timeout' => 2.0,
            'base_url' => array_key_exists("AUTOINSPECTOR_API_BASE_URL", $_ENV) ? $_ENV['AUTOINSPECTOR_API_BASE_URL'] : "https://api.autoinspector.com.ar/" . self::VERSION
        ];
    }
}
