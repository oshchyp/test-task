<?php declare(strict_types=1);

namespace App\Service\EmailSender;

interface SendToUserMessageInterface
{
    public function to(): string;

    public function getSubject(): string;

    public function getMessage(): string;
}
