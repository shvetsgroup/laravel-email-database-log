<?php

namespace Dmcbrn\LaravelEmailDatabaseLog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmailLogController extends Controller {

    public function index()
    {
        $emails = EmailLog::orderBy('id','desc')->paginate(20);

        return view('email-logger::index', compact('emails'));
    }

    public function show($id)
    {
        $email = EmailLog::find($id);

        return view('email-logger::show', compact('email'));
    }

    public function fetchAttachment()
    {
        $attachmentFullPath = 'email_log_attachments/ec8ba6a0d7323e9f1ad6461ac98c9994/classes-schedule-104712.ics';
        return Storage::get($attachmentFullPath);
    }
}