<?php

namespace Orders\Services\Sms;

use Illuminate\Support\Facades\Log;
use Orders\Contracts\Services\Sms\SmsMessageProviderInterface;

class STCSmsMessage implements SmsMessageProviderInterface
{
    public function send(string $phone, string $content): void
    {
        // Put the logic to send sms message via http client request
        // Example :
        
        // $response = Http::post('https://api.customsmsprovider.com/send', [
        //     'phone' => $phone,
        //     'message' => $message,
        //     'api_key' => env('SMS_API_KEY'), // Assuming you have the API key in the .env
        // ]);
        
        // For now, we’ll just log the message
        Log::info("Sending SMS to $phone : $content");
    }
}
