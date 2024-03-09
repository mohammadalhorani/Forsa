<?php

namespace App\Notifications;
use App\Models\Notes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoteCreated extends Notification
{
    use Queueable;


    protected $note;

    public function __construct(Notes $note)
    {
        $this->note = $note;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have a new Note.')
                    ->action('View Note', url('/notes'))
                    ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new note has been created!',
            'note_id' => $this->note->id, // Include any relevant information
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
