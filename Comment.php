<?php

namespace nspace;

include_once 'User.php';

use DateTime;
use User;

readonly class Comment
{
    public function __construct(private User $user, private string $message)
    {
    }

    public function isAfterDateTime(DateTime $dateTime): bool
    {
        return $this->user->getDataTimeCreate() > $dateTime;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}

