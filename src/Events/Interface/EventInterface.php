<?php

namespace Dmcbrn\LaravelEmailDatabaseLog\Events\Interface;

use Illuminate\Http\Request;

interface EventInterface
{
    public function verify(Request $request);
    public function saveEvent(Request $request);
}