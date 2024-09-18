<x-app-layout>
    <section>
        <div class="flex-container mb-4">
            <form id="filterForm" action="{{ route('jobposts.index') }}" method="GET" class="flex gap-4">

                <div>
                    <label for="position_type">Position Type:</label>
                    <select name="position_type" id="position_type" class="form-control" onchange="submitFilterForm()">
                        <option value="">All</option>
                        @foreach($positionTypes as $positionType)
                            <option value="{{ $positionType->value }}" {{ request('position_type') == $positionType->value ? 'selected' : '' }}>
                                {{ $positionType->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                

                <div>
                    <label for="location">Location:</label>
                    <select name="location" id="location" class="form-control" onchange="submitFilterForm()">
                        <option value="">All</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="salary">Minimum Salary:</label>
                    <input type="number" name="salary" id="salary" class="form-control" placeholder="0" value="{{ request('salary') }}" onchange="submitFilterForm()">
                </div>

                <x-secondary-button class="ms-3" onclick="window.location='{{ route('jobposts.index') }}'" width="4rem">{{ __('Clear') }}</x-secondary-button>
            </form>
        </div>
        <div class="flex-container">
            @foreach($jobposts as $jobpost)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $jobpost->job_title }}</h3>
                    <p class="card-text"><strong>Salary:</strong> {{ $jobpost->salary }}</p>
                    <p class="card-text"><strong>Position Type:</strong> {{ $jobpost->position_type }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $jobpost->location }}</p>
                    <p class="card-text"><strong>Company:</strong> {{ $jobpost->company->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Inline Script to Handle Form Submission -->
    <script>
        function submitFilterForm() {
            document.getElementById('filterForm').submit();
        }
    </script>
    
</x-app-layout>