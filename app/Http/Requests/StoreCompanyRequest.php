<?php

namespace App\Http\Requests;

use App\Services\BrasilApiService;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Troque para `false` se você tiver lógica de autorização específica
    }

    public function rules()
    {
        return [
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:companies,cnpj',
            'data_fundacao' => 'required|date',
            'email_responsavel' => 'required|string|email|max:255|unique:companies,email_responsavel',
            'nome_responsavel' => 'required|string|max:255',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!empty($this->cnpj)) {
                $brasilApiService = new BrasilApiService();
                $cnpjData = $brasilApiService->getCnpjData($this->cnpj);

                if (!$cnpjData) {
                    $validator->errors()->add('cnpj', 'O CNPJ é inválido ou não foi possível verificar.');
                } else {
                    $cnaes = array_column($cnpjData['cnaes_secundarios'], 'code');
                    $cnaes[] = $cnpjData['cnae_fiscal'];

                    if (!in_array('6202-3/00', $cnaes)) {
                        $validator->errors()->add('cnpj', 'O CNPJ não possui o CNAE 62.02-3/00 relacionado.');
                    }
                }
            }
        });
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'email_responsavel' => filter_var($this->email_responsavel, FILTER_SANITIZE_EMAIL),
            'razao_social' => strip_tags($this->razao_social),
            'nome_fantasia' => strip_tags($this->nome_fantasia),
            'nome_responsavel' => strip_tags($this->nome_responsavel),
            'cnpj' => preg_replace('/\D/', '', $this->cnpj), // Remove tudo que não for dígito
            // outras sanitizações...
        ]);
    }
}