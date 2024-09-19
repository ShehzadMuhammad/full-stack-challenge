<!-- resources/views/companies/show.blade.php -->
<x-app-layout>
    <section>
        <div class="button-container">
        <x-primary-button class="mt-4" x-data="" x-on:click="$dispatch('open-modal', 'create-job-post')">{{ __('Create Job Posting') }} </x-primary-button>
        <x-primary-button class="mt-4" x-data="" x-on:click="$dispatch('open-modal', 'update-company')">{{ __('Update Company') }} </x-primary-button>
        <div class="flex-container">
            <x-modal name="update-company" :show="false" focusable>
                <form id="update-company-form" method="POST" action="{{ route('companies.update', ['company' => $company->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <h2>Update Company</h2>
                        <input type="hidden" id="update_company_id" name="company_id" value="{{ old('company_id', $company->id) }}">
                        <label for="update_name">Company Name</label>
                        <input type="text" id="update_name" name="name" value="{{ old('name', $company->name) }}" placeholder="Enter Company Name">
                        <label for="update_industry">Industry</label>
                        <input type="text" id="update_industry" name="industry" value="{{ old('industry', $company->industry) }}" placeholder="Enter Industry">
                        <label for="update_location">Location</label>
                        <input type="text" id="update_location" name="location" value="{{ old('location', $company->location) }}" placeholder="Enter Location">
                        <label for="update_number_of_employees">Number of Employees</label>
                        <select id="update_number_of_employees" name="number_of_employees" class="form-control" required>
                            @foreach (\App\Enums\NumberOfEmployeesEnum::cases() as $numOfEmployees)
                                <option value="{{ $numOfEmployees->value }}" {{ old('number_of_employees', $company->number_of_employees) == $numOfEmployees->value ? 'selected' : '' }}>
                                    {{ $numOfEmployees->value }}
                                </option>
                            @endforeach
                        </select>
                        @error('number_of_employees')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-3" width="4rem">{{ __('Update') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </x-modal>
        </div>
        </div>
        <div class="flex-container">
            <x-modal name="create-job-post" :show="false" focusable>
                <form method="POST" action="{{ route('jobposts.store') }}">
                    @csrf
                    <div class="form-body">
                    <h2>Create Job Post</h2>
                    <label for="job_title">Job Title</label>
                    <input type="text" id="job_title" name="job_title" placeholder="Enter Job Title">
                    <label for="salary">Salary</label>
                    <input type="number" step="0.01" id="salary" name="salary" value="{{ old('salary') }}" placeholder="Enter Salary">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter Location">
                    <label for="position_type">Position Type</label>
                    <select id="position_type" name="position_type" class="form-control" required>
                        @foreach (\App\Enums\PositionTypeEnum::cases() as $position_type)
                            <option value="{{ $position_type->value }}" {{ old('position_type') == $position_type->value ? 'selected' : '' }}>
                                {{ $position_type->value }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-3">{{ __('Create Job Posting') }}</x-primary-button>
                        </div>
                    </div>
                </form>
        </x-modal>
           <div class="card">
               <div class="card-body">
                   <h3 class="card-title">{{ $company->name }}</h3>
                   <p class="card-text"><strong>Industry:</strong> {{ $company->industry }}</p>
                   <p class="card-text"><strong>Location:</strong> {{ $company->location }}</p>
                   <p class="card-text"><strong>Number of Employees:</strong> {{ $company->number_of_employees }}</p>
                   <p class="card-text"><strong>Number of Job Posts:</strong> {{ $company->job_posts_count }}</p>
               </div>
           </div>
        </div>
        <div>
           <h1>Job Posts</h1>
           <div class="flex-container">
                @if($jobPosts->isEmpty())
                    <p>No job posts available for this company.</p>
                @else
                    @foreach($jobPosts as $jobPost)
                    <div class="card">
                        <div class="card-body">
                            <strong>Job Title:</strong> {{ $jobPost->job_title }} <br>
                            <strong>Salary:</strong> {{ $jobPost->salary }} <br>
                            <strong>Location:</strong> {{ $jobPost->location }} <br>
                            <strong>Position Type:</strong> {{ $jobPost->position_type }}
                        <div class="mt-4 flex gap-2">
        
                            <x-primary-button x-data="" x-on:click="$dispatch('open-modal', 'update-job-post-{{ $jobPost->id }}')">{{ __('Update') }}</x-primary-button>
                            
                      
                            <form method="POST" action="{{ route('jobposts.destroy', $jobPost->id) }}" onsubmit="return confirm('Are you sure you want to delete this job post?');">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit">{{ __('Delete') }}</x-secondary-button>
                            </form>
                        </div>
                    </div>
                </div>


                <x-modal name="update-job-post-{{ $jobPost->id }}" :show="false" focusable>
                    <form method="POST" action="{{ route('jobposts.update', $jobPost->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <h2>Update Job Post</h2>
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                            <input type="hidden" name="job_post_id" value="{{ $jobPost->id }}">                
                            <label for="update_job_title">Job Title</label>
                            <input type="text" id="update_job_title" name="job_title" value="{{ old('job_title', $jobPost->job_title) }}" placeholder="Enter Job Title">
                            <label for="update_salary">Salary</label>
                            <input type="number" step="1000" id="update_salary" name="salary" value="{{ old('salary', $jobPost->salary) }}" placeholder="Enter Salary">
                            <label for="update_location">Location</label>
                            <input type="text" id="update_location" name="location" value="{{ old('location', $jobPost->location) }}" placeholder="Enter Location">
                            <label for="update_position_type">Position Type</label>
                            <select id="update_position_type" name="position_type" class="form-control" required>
                                @foreach (\App\Enums\PositionTypeEnum::cases() as $position_type)
                                    <option value="{{ $position_type->value }}" {{ old('position_type', $jobPost->position_type) == $position_type->value ? 'selected' : '' }}>
                                        {{ $position_type->value }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-primary-button class="ms-3" width="4rem">{{ __('Update') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                </x-modal>
                    @endforeach  
            </div> 
                    <div class="pagination">
                        {{ $jobPosts->links() }}
                    </div>
                @endif
        </div>
    </section>
</x-app-layout>