<?php

namespace User\Infrastructure\Notification\Sms\Sender;

use User\Domain\Service\SmsSenderInterface;

class StubSmsSender implements SmsSenderInterface
{
    public function send(string $phoneCode, string $phoneNumber, string $message): void
    {
    }
}
