<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Enums\NumberOfEmployeesEnum;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $companies = Company::withCount('jobPosts')->get();


        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'industry' => 'required|max:255',
            'location' => 'required|max:255',
            'number_of_employees' => ['required', Rule::in(array_column(NumberOfEmployeesEnum::cases(), 'value'))],
        ]);

        Company::create([
            'name' => $validated['name'],
            'industry' => $validated['industry'],
            'location' => $validated['location'],
            'number_of_employees' => $validated['number_of_employees'],
        ]);

        // Redirect with success message
        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): View
    {
        $jobPosts = $company->jobPosts()->paginate(5);
        return view('companies.show', compact('company', 'jobPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $company->update($request->all());

        return redirect()->route('companies.show', $company->id)->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect(route('companies.index'));
    }
}
