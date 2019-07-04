<?php

namespace Dmcbrn\LaravelEmailDatabaseLog\LaravelEvents;

use Illuminate\Queue\SerializesModels;
use Dmcbrn\LaravelEmailDatabaseLog\EmailLog;

class EmailLogged
{
	use SerializesModels;
	
    public $emailLog;

    /**
     * Create a new event instance.
     *
     * @param  Dmcbrn\LaravelEmailDatabaseLog\EmailLog  $emailLog
     * @return void
     */
    public function __construct(EmailLog $emailLog)
    {
        $this->emailLog = $emailLog;
    }
}