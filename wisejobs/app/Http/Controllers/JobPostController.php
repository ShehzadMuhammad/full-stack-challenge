<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use App\Enums\PositionTypeEnum;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $query = JobPost::query();

        $positionTypes = PositionTypeEnum::cases();
        $locations = JobPost::select('location')->distinct()->pluck('location');
        if ($request->filled('position_type')) {
            $query->where('position_type', $request->position_type);
        }
    
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
    
        if ($request->filled('salary')) {
            $query->where('salary', '>=', $request->salary);
        }
    
        $jobposts = $query->with('company')->paginate(8)->appends($request->query());

        return view('jobposts.index', compact('jobposts', 'positionTypes', 'locations'));
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

        $jobPost = JobPost::create([
            'job_title' => $validated['job_title'],
            'salary' => $validated['salary'],
            'location' => $validated['location'],
            'company_id' => $validated['company_id'],
            'position_type' => $validated['position_type'],
        ]);

        return redirect()->route('companies.show', ['company' => $jobPost->company_id])->with('success', 'Job Post created successfully!');
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
    public function update(Request $request, JobPost $jobPost): View
    {
        $jobPost->update($request->all());
        return view('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost): View
    {
        $companyId = $jobPost->company_id;
        dd($jobPost);
        $jobPost->delete();

        return view('companies.index');
    }
}
