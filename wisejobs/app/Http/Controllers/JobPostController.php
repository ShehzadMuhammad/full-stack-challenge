<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Enums\PositionTypeEnum;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('jobposts.index');
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
            'job_title' => 'required|string|max:50',
            'salary' => 'required|numeric|min:0',
            'location' => 'required|max:255',
            'company_id' => 'required|exists:companies,id',
            'position_type' => ['required', Rule::in(array_column(PositionTypeEnum::cases(), 'value'))],
        ]);

        JobPost::create([
            'job_title' => $validated['job_title'],
            'salary' => $validated['salary'],
            'location' => $validated['location'],
            'company_id' => $validated['company_id'],
            'position_type' => $validated['position_type'],
        ]);

        // Redirect with success message
        return redirect()->route('companies.index')->with('success', 'Job Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $jobPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        //
    }
}
