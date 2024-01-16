<?php

namespace HeroSeguros\HeroLaravelLibrary\Traits;

use ReflectionClass;

trait FlagEnumTrait
{
    /**
     * Recebe um array de enums e retorna a soma deles.
     *
     * @param array $enums Array de enums para somar.
     * @return int A soma dos valores do enum.
     */
    public static function sumEnums(array $enums): int
    {
        $sum = 0;
        foreach ($enums as $enum) {
            $sum |= $enum;
        }

        return $sum;
    }

    /**
     * Recebe um valor de soma e retorna os enums individuais que a compõem.
     *
     * @param int $sum A soma dos valores do enum.
     * @return array Um array dos enums individuais.
     */
    public static function decomposeEnum(int $sum): array
    {
        $components = [];
        $reflection = new ReflectionClass(__CLASS__);
        $constants = $reflection->getConstants();

        foreach ($constants as $enum) {
            if ($sum & $enum) {
                $components[] = $enum;
            }
        }

        return $components;
    }
}