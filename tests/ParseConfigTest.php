<?php

use App\ParseConfig;
use PHPUnit\Framework\TestCase;

class ParseConfigTest extends TestCase
{
    /**
     * Test empty config file
     */
    public function testParseEmpty()
    {
        $this->assertEquals([], ParseConfig::parse(""));
    }
}
