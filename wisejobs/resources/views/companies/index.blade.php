<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('companies.store') }}">
            @csrf
            <input type="text" id="name" name="name" placeholder="Enter Company Name">
            <input type="text" id="industry" name="industry" placeholder="Enter Industry">
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
            <x-primary-button class="mt-4">{{ __('Create Company') }}</x-primary-button>
        </form>
    </div>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('jobposts.store') }}">
            @csrf
            <input type="text" id="job_title" name="job_title" placeholder="Enter Job Title">
            <label for="salary">Salary</label>
            <input type="number" step="0.01" id="salary" name="salary" value="{{ old('salary') }}" placeholder="Enter Salary">
            @error('salary')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="text" id="location" name="location" placeholder="Enter Location">
            <select id="position_type" name="position_type" class="form-control" required>
                @foreach (\App\Enums\PositionTypeEnum::cases() as $position_type)
                    <option value="{{ $position_type->value }}" {{ old('position_type') == $position_type->value ? 'selected' : '' }}>
                        {{ $position_type->value }}
                    </option>
                @endforeach
            </select>
            @error('number_of_employees')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="company_id">Company</label>
            <select id="company_id" name="company_id" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <x-primary-button class="mt-4">{{ __('Create Job Post') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>