<?php

namespace HeroSeguros\HeroLaravelLibrary\Helpers;

class ValidationHelper
{
    /**
     * Verifica se o número do cartão de crédito informado é valido
     * @param string $creditCardNumber
     * @return bool
     */
    public static function isValidCreditCardNumber(string $creditCardNumber): bool
    {
        $number = preg_replace('/\D/', '', $creditCardNumber);
        $sum = 0;
        $shouldDouble = false;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $digit = (int) $number[$i];

            if ($shouldDouble) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
            $shouldDouble = !$shouldDouble;
        }
        return $sum % 10 === 0;
    }
}
