<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>{{ $job['title'] }}</h1>
            <p><strong>Location:</strong> {{ $job['location'] }}</p>
            <p><strong>Department:</strong> {{ $job['department'] }}</p>
            <p><strong>Employment Type:</strong> {{ $job['employment_type'] }}</p>

            <div class="job-description">
                {!! $job['description'] !!}
            </div>

            <a href="{{ $job['url'] }}" target="_blank" class="btn btn-primary mt-3">Apply Now</a>
        </div>
    </div>
</div>