<?php

namespace Dmcbrn\LaravelEmailDatabaseLog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmailLogController extends Controller {

    public function index()
    {
        $emails = EmailLog::select('id','date','from','to','subject')->orderBy('id','desc')->paginate(20);

        return view('email-logger::index', compact('emails'));
    }

    public function show($id)
    {
        $email = EmailLog::find($id);

        return view('email-logger::show', compact('email'));
    }

    public function fetchAttachment($id,$attachment)
    {
        $email = EmailLog::select('id','attachments')->find($id);
        $attachmentFullPath = explode(',',$email->attachments)[$attachment];

        return Storage::get(urldecode($attachmentFullPath));
    }
}