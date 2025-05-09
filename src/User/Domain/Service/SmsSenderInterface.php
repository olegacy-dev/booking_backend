<?php

namespace User\Domain\Service;

interface SmsSenderInterface
{
    public function send(string $phoneCode, string $phoneNumber, string $message): void;
}
