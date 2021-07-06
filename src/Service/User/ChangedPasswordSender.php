<?php declare(strict_types=1);

namespace App\Service\User;

use App\Object\EmailMessage;
use App\Service\EmailSender\EmailSenderInterface;

final class ChangedPasswordSender implements ChangedPasswordSenderInterface
{
    public function __construct(
        private EmailSenderInterface $emailSender
    )
    {
    }

    public function send(string $email, string $password): void
    {
        $this->emailSender->sendToUser(new EmailMessage(
            to: $email,
            message: sprintf('New password: %s', $password),
            subject: 'New password'
        ));
    }
}
