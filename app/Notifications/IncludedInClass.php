<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Season;
use App\User;
use App\Course;

class IncludedInClass extends Notification
{
    use Queueable;

    protected $season;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Season $season)
    {
        $this->season = $season;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $teacher = User::find($this->season->user_id);
        $course = Course::find($this->season->course_id);
        return (new MailMessage)
                    ->greeting('Hi There!')
                    ->line('You have been added to '.$teacher->name.'\'s '.$course->title.' class , use the link below to view additional information.')
                    ->action('Visit the website', url('/'))
                    ->line('Thank you for using Exam!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
