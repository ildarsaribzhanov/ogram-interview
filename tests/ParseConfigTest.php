<?php

use App\ParseConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class ParseConfigTest
 */
class ParseConfigTest extends TestCase
{
    /**
     * Test empty config file
     */
    public function testParseEmpty()
    {
        $this->assertEquals([], ParseConfig::parse(""));
        $this->assertEquals([], ParseConfig::parse("
        
        "));
    }

    /**
     * Test one basic line
     */
    public function testParseBasicOneLine()
    {
        $this->assertEquals(['param' => 'value'], ParseConfig::parse("param=value"));
    }
}
