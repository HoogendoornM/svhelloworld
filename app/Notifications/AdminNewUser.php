<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminNewUser extends Notification
{
    use Queueable;

    public $first_name;
    public $name_prefix = "";
    public $last_name;
    public $phone_number;
    public $email;

    public function __construct($first_name, $name_prefix, $last_name, $phone_number, $email)
    {
        $this->first_name = $first_name;
        $this->name_prefix = $name_prefix;
        $this->last_name = $last_name;
        $this->phone_number = $phone_number;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line(__('Een nieuw lid heeft zich aangemeld voor de studievereniging'))
            ->line(__('Naam') . ': ' . $this->first_name . ' ' . $this->name_prefix . ' ' . $this->last_name)
            ->line(__('Telefoonnummer') . ': ' . $this->phone_number)
            ->line('Email: ' . $this->email)
            ->action(__('Gebruikers beheren'), url('http://mijn.svhelloworld.nl/gebruikers'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
