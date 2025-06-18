<?php

namespace App\Traits;

trait ModelTrait
{
    // Função auxiliar para converter vírgula em ponto e tratar valores nulos
    private function convertToDecimal($value)
    {
        return $value !== null ? str_replace(',', '.', $value) : null;
    }
}
