<?php

namespace Dmcbrn\LaravelEmailDatabaseLog\Events;
use Dmcbrn\LaravelEmailDatabaseLog\Events\MailgunEvent;

class EventFactory
{
    public static function create($type)
    {
    	if($type == 'mailgun')
	        return new MailgunEvent();

	    return false;
    }
}