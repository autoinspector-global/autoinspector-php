<?php

namespace Autoinspector;


use Autoinspector\Service\CoreServiceFactory;
use Error;
use GuzzleHttp;


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

        $this->httpClient = new GuzzleHttp\Client([
            'base_uri' => $this->configuration['base_url'],
            'timeout' => $this->configuration['timeout'],
            'headers' => ['x-api-key' => $this->configuration['api_key'], 'User-Agent' => "autoinspector-php-sdk/" . self::VERSION]
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
            'timeout' => 20,
            'base_url' =>  "https://api.stg-autoinspector.com.ar/" . self::VERSION . '/'
        ];
    }
}
