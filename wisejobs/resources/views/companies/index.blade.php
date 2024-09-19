<x-app-layout>
    <div class="button-container">
        <x-primary-button class="mt-4" x-data="" x-on:click="$dispatch('open-modal', 'create-company')">{{ __('Create Company') }} </x-primary-button>
        <x-modal name="create-company" :show="false" focusable>
        <form method="POST" action="{{ route('companies.store') }}">
            @csrf
            <div class="form-body">
            <h2>Create Company</h2>
            <label for="name">Company Name</label>
            <input type="text" id="name" name="name" placeholder="Enter Company Name">
            <label for="industry">Industry</label>
            <input type="text" id="industry" name="industry" placeholder="Enter Industry">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter Location">
            <label for="number_of_employees">Number of Employees</label>
            <select id="number_of_employees" name="number_of_employees" class="form-control" required>
                @foreach (\App\Enums\NumberOfEmployeesEnum::cases() as $numOfEmployees)
                    <option value="{{ $numOfEmployees->value }}" {{ old('number_of_employees') == $numOfEmployees->value ? 'selected' : '' }}>
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
            <x-primary-button class="ms-3" width="4rem">{{ __('Create') }}</x-primary-button>
            </div>
        </div>
        </form>
    </x-modal>
    </div>
    <section>
        <div class="flex-container">
            @foreach($companies as $company)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a>
                    </h3>    
                    <p class="card-text"><strong>Industry:</strong> {{ $company->industry }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $company->location }}</p>
                    <p class="card-text"><strong>Number of Employees:</strong> {{ $company->number_of_employees }}</p>
                    <p>Number of Job Posts: {{ $company->job_posts_count }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</x-app-layot>