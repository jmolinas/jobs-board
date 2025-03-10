<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FirstJobPosted;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')] 
class JobForm extends Component
{
    #[Validate('required|string|min:5')] 
    public string $title = '';

    #[Validate('required')] 
    public string $description = '';

    #[Validate('required|string|min:5')] 
    public string $company = '';

    #[Validate('required|string|min:5')] 
    public string $location = '';

    #[Validate('required|string|min:2')] 
    public string $department = '';

    #[Validate('required|string')] 
    public string $employment_type = '';

    #[Validate('required|string')] 
    public string $schedule = '';


    public function save()
    {
        $user = auth()->user();
        $this->validate();

        $job = $user->jobs()->create([
            'title' => $this->title,
            'company' => $this->company,
            'description' => $this->description,
            'location' => $this->location,
            'department' => $this->department,
            'employment_type' => $this->employment_type,
            'schedule' => $this->schedule,
        ]);

        // Check if it's the user's first job
        if ($user->jobs()->count() === 1) {
            $moderators = User::role('moderator')->get();
            Notification::send($moderators, new FirstJobPosted($job));
        }
        $this->reset();
        $this->dispatch('reset-trix');
        session()->flash('message', 'Job posted successfully.');
    }

    public function render()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to post a job.');
        }
        return view('livewire.job-form');
    }
}
