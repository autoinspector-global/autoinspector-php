<?php

namespace Autoinspector;

use PHPUnit\Framework\TestCase;

final class AutoinspectorClientTest extends TestCase
{

    use TestHelper;

    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }


    public function test_default_options()
    {
        $conf = $this->autoinspector->getDefaultConfiguration();

        $this->assertEquals('https://api.autoinspector.com.ar/v1/', $conf['base_url']);
    }
}
