<div class="p-4 border rounded">
    <h2 class="text-xl font-bold">{{ $job->title }}</h2>
    <p><strong>Status:</strong> <span class="badge badge-{{ $job->status }}">{{ ucfirst($job->status) }}</span></p>
    
    <button wire:click="markAsPublished" class="btn btn-success" {{ $job->isPublished() ? 'disabled' : '' }}>
        Mark as Published
    </button>
    
    <button wire:click="markAsSpam" class="btn btn-danger" {{ $job->isSpam() ? 'disabled' : '' }}>
        Mark as Spam
    </button>
</div>
