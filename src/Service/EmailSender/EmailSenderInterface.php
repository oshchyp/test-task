<?php declare(strict_types=1);

namespace App\Service\EmailSender;

interface EmailSenderInterface
{
    /**
     * @param SendToUserMessageInterface $message
     */
    public function sendToUser(SendToUserMessageInterface $message): void;
}
