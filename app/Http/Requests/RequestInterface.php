<?php

namespace App\Http\Requests;

interface RequestInterface
{
    // Defina os métodos que todas as requisições devem implementar
    public function authorize(): bool;
    public function rules(): array;
}
