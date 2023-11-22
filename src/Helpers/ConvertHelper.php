<?php

namespace HeroSeguros\HeroLaravelLibrary\Helpers;

class ConvertHelper
{
    /**
     * Converte um valor em centavos para um valor em reais
     * @param int $value
     * @return float
     */
    public static function centsToReal(int $value): float
    {
        return $value / 100;
    }

    /**
     * Converte um valor em reais para um valor em centavos
     * @param float $value
     * @return int
     */
    public static function realToCents(float $value): int
    {
        return (int) ($value * 100);
    }
}