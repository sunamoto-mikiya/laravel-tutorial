<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class SlackDateNotification extends Notification
{
    use Queueable;

    /**
     * @var string $str
     */
    private $title;
    private $submission;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title = null, $submission = null)
    {
        $this->title = $title;
        $this->submission = $submission;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Slack通知
     *
     * @param mixed $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)->from('締め切り通知')->content("タスク名：" . $this->title . "\n" . "締め切り：" . $this->submission);
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
