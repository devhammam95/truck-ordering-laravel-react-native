<?php

namespace Orders\Contracts\Services\Sms;

interface SmsMessageProviderInterface
{
    public function send( string  $phone, string $content): void;
}
