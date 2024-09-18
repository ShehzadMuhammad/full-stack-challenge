<x-app-layout>
    <section>
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
</x-app-layout>