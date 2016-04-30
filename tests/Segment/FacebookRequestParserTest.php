<?php
/*
 * This file is part of Worker.
 *
 ** (c) 2016 - Fumikazu Fujiwara
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imomushi\Worker\Tests;

use Imomushi\Worker\Segment\FacebookRequestParser;

/**
 * Class FacebookRequestParserTest
 *
 * @package Imomushi\Worker\Tests
 */

class FacebookRequestParserTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @vars
     */
    private $target;
    public function setUp()
    {
        $this -> target = new FacebookRequestParser();

    }

    public function tearDown()
    {
    }

    public function testConstruct()
    {
        $this -> assertInstanceOf(
            'Imomushi\Worker\Segment\FacebookRequestParser',
            $this -> target
        );
    }

    public function testExecute()
    {
        $this -> assertTrue(
            method_exists(
                $this -> target,
                'execute'
            )
        );
    }
}
