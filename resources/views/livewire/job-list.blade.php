<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-xl font-bold mb-4">Job Listings</h2>
            <ul>
                @foreach ($jobs as $job)
                <li class="p-2 border-b">
                    <h3 class="font-semibold">{{ $job->title }}</h3>
                    <p>{{ $job->description }}</p>
                    <p class="text-sm text-gray-500">Posted by User #{{ $job->user_id }}</p>
                </li>
                @endforeach
                @foreach ($positions as $position)
                <li class="p-2 border-b">
                    <h3 class="font-semibold">{{ $position['title'] }}</h3>
                    <p>{!! $position['description'] !!}</p>
                    <a href="{{ route('jobs.details', ['id' => $position['id']]) }}" class="btn btn-secondary">View Details</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>