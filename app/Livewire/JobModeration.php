<?php

namespace App\Livewire\Moderation;

use Livewire\Component;
use App\Models\JobsBoard as Job;

class JobModeration extends Component
{
    public $job;

    public function mount($jobId)
    {
        $this->job = Job::findOrFail($jobId);
    }

    public function markAsPublished()
    {
        $this->job->update(['status' => 'published']);
    }

    public function markAsSpam()
    {
        $this->job->update(['status' => 'spam']);
    }

    public function render()
    {
        return view('livewire.moderation.job-moderation');
    }
}
