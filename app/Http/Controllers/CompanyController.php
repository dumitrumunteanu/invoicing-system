<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    public function update(CompanyUpdateRequest $request)
    {
        $user = $request->user();
        $companyData = $request->validated();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $companyData['logo'] = $logoPath;
        }

        if ($user->company) {
            $user->company->update($companyData);
        } else {
            $company = new Company($companyData);
            $user->company()->save($company);
        }

        if ($user->company) {
            $user->company->update($companyData);
        } else {
            $company = new Company($companyData);
            $user->company()->save($company);
        }

        return Redirect::route('dashboard')->with('status', 'company-details-updated');
    }
}
