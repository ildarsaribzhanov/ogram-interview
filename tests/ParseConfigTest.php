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

    /**
     * If empty value
     */
    public function testEmptyValue()
    {
        $this->assertEquals(['param' => ''], ParseConfig::parse("param="));
    }

    /**
     * parse nested key
     */
    public function testParseNestedOneLine()
    {
        $this->assertEquals(['param' => ['nested' => 'value']], ParseConfig::parse("param.nested=value"));
        $this->assertEquals(['param' => ['nested' => ['2' => 'value']]], ParseConfig::parse("param.nested.2=value"));
    }
}
