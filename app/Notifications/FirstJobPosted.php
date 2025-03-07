<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FirstJobPosted extends Notification
{
    use Queueable;

    public $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New First-Time Job Post')
            ->line('A user has posted a job for the first time.')
            ->action('Review Job', url('/admin/jobs/' . $this->job->id));
    }

    public function toArray($notifiable)
    {
        return [
            'job_id' => $this->job->id,
            'user_id' => $this->job->user_id,
            'message' => 'A first-time user has posted a job.',
        ];
    }
}
