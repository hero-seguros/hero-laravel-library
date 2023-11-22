<?php

namespace HeroSeguros\HeroLaravelLibrary\Tests\Unit\Helpers;

use HeroSeguros\HeroLaravelLibrary\Helpers\ConvertHelper;
use PHPUnit\Framework\TestCase;

class ConvertHelperTest extends TestCase
{
    public function testCentsToReal()
    {
        $centValue = 10000;
        $realValue = 100;

        $result = ConvertHelper::centsToReal($centValue);
        $this->assertEquals($realValue, $result);
    }

    public function testRealToCents()
    {
        $centValue = 10000;
        $realValue = 100;

        $result = ConvertHelper::realToCents($realValue);
        $this->assertEquals($centValue, $result);
    }
}
