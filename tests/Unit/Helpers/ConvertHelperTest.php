<?php

namespace HeroSeguros\HeroLaravelLibrary\Tests\Unit\Helpers;

use HeroSeguros\HeroLaravelLibrary\Helpers\ConvertHelper;
use PHPUnit\Framework\TestCase;

class ConvertHelperTest extends TestCase
{
    /** @test */
    public function it_does_something()
    {
        $centValue = 10000;
        $realValue = 100;

        $result = ConvertHelper::centsToReal($centValue);
        $this->assertEquals($realValue, $result);

        $result = ConvertHelper::realToCents($realValue);
        $this->assertEquals($centValue, $result);
    }
}
