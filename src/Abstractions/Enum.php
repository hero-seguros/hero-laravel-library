<?php

namespace HeroSeguros\HeroLaravelLibrary\Abstractions;

abstract class Enum
{
    /**
     * @return array
     */
    public static function all(): array
    {
        return (new static())->all;
    }

    /**
     * @return array
     */
    public static function keys(): array
    {
        return array_keys(self::all());
    }

    /**
     * @param string $value
     * @return string
     */
    public static function getKey(string $value): string
    {
        return array_search($value, self::all());
    }

    /**
     * @return array
     */
    public static function get(): array
    {
        return self::all();
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public static function find(string $key, mixed $default = null): mixed
    {
        return Arr::get(self::all(), $key) ?? $default;
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_values(self::all());
    }
}