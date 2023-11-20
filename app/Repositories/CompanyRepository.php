<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function getAll()
    {
        return Company::all();
    }

    public function findById($id)
    {
        return Company::find($id);
    }

    public function create(array $attributes)
    {
        return Company::create($attributes);
    }

    public function update(Company $company, array $attributes)
    {
        $company->update($attributes);
        return $company;
    }

    public function delete(Company $company)
    {
        return $company->delete();
    }
}