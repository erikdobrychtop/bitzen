<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCompany()
    {
        $repository = new CompanyRepository();
        $companyData = [
            'name' => 'Test Company',
            // outros campos necessários...
        ];

        $company = $repository->create($companyData);

        $this->assertInstanceOf(Company::class, $company);
        $this->assertEquals('Test Company', $company->name);
        // outros asserts para verificar se todos os campos foram criados corretamente...
    }
}