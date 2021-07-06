<?php declare(strict_types=1);

namespace App\Object;

use App\Service\EmailSender\SendToUserMessageInterface;

final class EmailMessage implements SendToUserMessageInterface
{
    public function __construct(
        private string $to,
        private string $message,
        private string $subject = ''
    )
    {
    }

    public function to(): string
    {
        return $this->to;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
