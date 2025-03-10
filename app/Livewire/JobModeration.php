<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobsBoard as Job;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class JobModeration extends Component
{
    public $job;

    public function mount($id)
    {
        $this->job = Job::findOrFail($id);
    }

    public function markAsPublished()
    {
        $this->job->update(['status' => 'published']);
        session()->flash('message', 'Job published successfully!');

        return redirect()->route('jobs.details', $this->job->id);
    }

    public function markAsSpam()
    {
        $this->job->update(['status' => 'spam']);
        session()->flash('error', 'Job marked as spam.');
        return redirect()->route('jobs.details', $this->job->id);
    }

    public function render()
    {
        return view('livewire.job-moderation');
    }
}
