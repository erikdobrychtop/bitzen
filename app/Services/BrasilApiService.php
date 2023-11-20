<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrasilApiService
{
    public function getCnpjData($cnpj)
    {
        $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/$cnpj");

        if ($response->successful()) {
            return $response->json();
        } else {
            return null; // ou lançar uma exceção específica
        }
    }
}
