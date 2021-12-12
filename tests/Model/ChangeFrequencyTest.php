<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Builder\Model;

use PHPUnit\Framework\TestCase;
use SitemapPlugin\Builder\Model\ChangeFrequency;

final class ChangeFrequencyTest extends TestCase
{
    /**
     * @param $interval
     * @dataProvider dataProvider
     */
    public function testBasic($interval)
    {
        $obj = ChangeFrequency::$interval();
        $castedString = (string) $obj;
        $toString = $obj->__toString();

        $this->assertSame($interval, $castedString);
        $this->assertSame($interval, $toString);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            ['daily'],
            ['always'],
            ['hourly'],
            ['weekly'],
            ['monthly'],
            ['yearly'],
            ['never'],
        ];
    }
}
