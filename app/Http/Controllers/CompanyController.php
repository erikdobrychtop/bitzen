<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(): JsonResponse
    {
        $companies = $this->companyService->getAllCompanies();
        return response()->json($companies);
    }

    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $company = $this->companyService->createCompany($request->validated());
        return response()->json($company, 201);
    }

    public function show(Company $company): JsonResponse
    {
        $company = $this->companyService->getCompanyById($company->id);
        return response()->json($company);
    }

    public function update(StoreCompanyRequest $request, Company $company): JsonResponse
    {
        $updatedCompany = $this->companyService->updateCompany($company, $request->validated());
        return response()->json($updatedCompany);
    }

    public function destroy(Company $company): JsonResponse
    {
        $this->companyService->deleteCompany($company);
        return response()->json(['message' => 'Company deleted successfully'], 204);
    }
}
