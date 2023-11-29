<?php

namespace HeroSeguros\HeroLaravelLibrary\Helpers;

class FormatHelper
{
    /**
     * Converte um valor float para o formato monetário brasileiro.
     *
     * @param float $amount Valor a ser formatado.
     * @return string Valor formatado como moeda no padrão brasileiro.
     */
    public static function moneyToBr(float $amount): string
    {
        return 'R$ ' . number_format($amount, 2, ',', '.');
    }

    /**
     * Converte uma data do formato 'yyyy-mm-dd' para o formato brasileiro 'dd/mm/yyyy'.
     *
     * @param string $date Data a ser formatada.
     * @return string Data formatada no padrão brasileiro.
     */
    public static function dateToBr(string $date): string
    {
        return date('d/m/Y', strtotime($date));
    }

    /**
     * Formata uma string de CPF.
     *
     * @param string $cpf String contendo o CPF sem formatação.
     * @return string CPF formatado.
     */
    public static function cpf(string $cpf): string
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) === 11) {
            return substr($cpf, 0, 3) . '.' .
                substr($cpf, 3, 3) . '.' .
                substr($cpf, 6, 3) . '-' .
                substr($cpf, 9, 2);
        }

        return $cpf;
    }
}
