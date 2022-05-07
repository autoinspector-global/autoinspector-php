<?php

namespace Autoinspector\Service;


use Autoinspector\TestHelper;
use PHPUnit\Framework\TestCase;

final class OAuthServiceTest extends TestCase
{
    use TestHelper;
    private $autoinspector;

    public function setUp(): void
    {
        $this->autoinspector = $this->setupSDK();
    }

    public function test_buildAuthorizationLink()
    {

        $authorizationURL =  $this->autoinspector->oauth->buildAuthorizationLink([
            "memberships",
            "account",
            "inspections"
        ]);


        $this->assertArrayHasKey("query", parse_url($authorizationURL));

        $queryParsed = [];
        parse_str(parse_url($authorizationURL)["query"], $queryParsed);

        $this->assertArrayHasKey("scopes", $queryParsed);
        $this->assertCount(3, $queryParsed["scopes"]);
    }
}
