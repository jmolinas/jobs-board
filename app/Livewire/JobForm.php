<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FirstJobPosted;

#[Layout('layouts.app')] 
class JobForm extends Component
{
    #[Validate('required|string|min:5')] 
    public string $title = '';

    #[Validate('required|string|min:10')] 
    public string $description = '';

    public function save()
    {
        $user = auth()->user();
        $this->validate();

        $job = $user->jobs()->create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Check if it's the user's first job
        if ($user->jobs()->count() === 1) {
            $moderators = User::role('moderator')->get();
            Notification::send($moderators, new FirstJobPosted($job));
        }

        session()->flash('message', 'Job posted successfully.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.job-form');
    }
}
