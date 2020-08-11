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

    /**
     * test many lines config
     */
    public function testMultiLine()
    {
        $str = "
        param1=val1
        param2=val2";

        $this->assertEquals(['param1' => 'val1', 'param2' => 'val2'], ParseConfig::parse($str));
    }

    /**
     * test multiline with nested keys
     */
    public function testMultiLineWithNested()
    {
        $str = "
        param1.in1=val11
        param1.in2=val12
        param1.num=200
        param2.in1=val2";

        $this->assertEquals([
            'param1' => ['in1' => 'val11', 'in2' => 'val12', 'num' => 200],
            'param2' => ['in1' => 'val2']
        ], ParseConfig::parse($str));
    }

    /**
     * Test string
     */
    public function testNeedle()
    {
        $str = "db.user=root
            db.password=
            debug=true
            passwrod.manager.secret.key=adaD@d3D2D2=";

        $expect = [
            'db'       => [
                'user'     => 'root',
                'password' => ''
            ],
            'debug'    => true,
            'passwrod' => [
                'manager' => [
                    'secret' => [
                        'key' => 'adaD@d3D2D2='
                    ]
                ]
            ]
        ];

        $this->assertEquals($expect, ParseConfig::parse($str));
    }
}
