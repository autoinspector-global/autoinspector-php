<?php

namespace Autoinspector\Service;

use Autoinspector\TestHelper;
use PHPUnit\Framework\TestCase;

final class TemplateServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }

    public function test_list_templates()
    {
        $response =  $this->autoinspector->templates->list();

        $this->assertIsArray($response);
        $this->assertGreaterThan(0, count($response));
    }
}
