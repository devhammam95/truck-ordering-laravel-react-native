<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use App\Services\SmsService;
use Orders\Contracts\Services\Sms\SmsMessageProviderInterface;
use Users\Models\User;

class SmsChannel
{
    protected $smsService;

    public function __construct(SmsMessageProviderInterface $smsService)
    {
        $this->smsService = $smsService;
    }

    // Send the SMS
    public function send($notifiable, Notification $notification)
    {
        // Get the phone number and message from the notification
        $messageData = $notification->toSms($notifiable);

        // Call the SMS service to send the message
        $this->smsService->send($messageData['phone'], $messageData['msg_content']);
    }
}
