<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreCompany()
    {
        $user = User::factory()->create();
        $companyData = [
            'razao_social' => 'Test Company Inc',
            'nome_fantasia' => 'Test Company',
        ];

        $response = $this->actingAs($user)->postJson('/api/companies', $companyData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('companies', [
            'razao_social' => 'Test Company Inc',
        ]);
    }
}
