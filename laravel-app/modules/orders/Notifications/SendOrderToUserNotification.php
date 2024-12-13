<?php

namespace Orders\Notifications;

use App\Broadcasting\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Console\View\Components\Line;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Orders\Contracts\Services\Sms\SmsMessageProviderInterface;
use Orders\Services\STCSmsMessage;
use Users\Models\User;

class SendOrderToUserNotification extends Notification
{
    use Queueable;

    private User $user;
    private string $msgContent;
    private string $notificationType;
    private string $userIdentifier;


    /**
     * Create a new notification instance.
     */
    public function __construct(int $userId, string $msgContent, string $notificationType)
    {
        $this->user = User::where('id', $userId)->first();
        $this->userIdentifier = $notificationType == 'sms' ? $this->user->phone :$this->user->email;
        $this->msgContent = $msgContent;
        $this->notificationType = $notificationType;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [$this->notificationType == 'sms' ? SmsChannel::class : $this->notificationType];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line("Hello {$this->user->name}")
                    ->line($this->msgContent);
    }

    // Send SMS using Twilio
    public function toSms($notifiable)
    {
        return [
            'msg_content' => $this->msgContent,
            'phone' => $this->userIdentifier,
        ];    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'user_identifier' => $this->userIdentifier,
            'msg_content' => $this->msgContent,
            'notificationype' => $this->notificationType,
        ];
    }
}
