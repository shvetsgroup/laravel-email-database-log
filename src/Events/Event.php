<?php

namespace Dmcbrn\LaravelEmailDatabaseLog\Events;

use Dmcbrn\LaravelEmailDatabaseLog\EmailLog;
use Dmcbrn\LaravelEmailDatabaseLog\Events\Interfaces\EventInterface;

abstract class Event implements EventInterface
{
    public function getEmail($messageId)
    {
        return EmailLog::select('id', 'messageId')
            ->where('messageId', $messageId)
            ->first();
    }
}