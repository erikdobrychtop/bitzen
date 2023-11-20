<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    protected $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCompanies()
    {
        return $this->repository->getAll();
    }

    public function getCompanyById($id)
    {
        return $this->repository->findById($id);
    }

    public function createCompany(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCompany($company, array $data)
    {
        return $this->repository->update($company, $data);
    }

    public function deleteCompany($company)
    {
        return $this->repository->delete($company);
    }
}
