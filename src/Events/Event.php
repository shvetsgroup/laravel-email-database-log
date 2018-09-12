<?php

namespace Dmcbrn\LaravelEmailDatabaseLog\Events;

use Dmcbrn\LaravelEmailDatabaseLog\EmailLog;
use Dmcbrn\LaravelEmailDatabaseLog\Events\Interface\EventInterface;

class Event implements EventInterface
{
    private function getEmail($messageId)
    {
        return EmailLog::select('id', 'messageId')
            ->where('messageId', $messageId)
            ->first();
    }
}