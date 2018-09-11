<?php

namespace Dmcbrn\LaravelEmailDatabaseLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmailLogController extends Controller {

    public function index()
    {
        $emails = EmailLog::with([
                'events' => function($q) {
                    $q->select('messageId','created_at','event');
                }
            ])
            ->select('id','date','from','to','subject')
            ->orderBy('id','desc')
            ->paginate(20);

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

    public function createEvent(Request $request)
    {
        //verify
        if(!$this->verify($request))
            return response('Error: verification failed', 400)->header('Content-Type', 'text/plain');

        //save event
        return $this->saveEvent($request);
    }

    private function verify($request)
    {
        //get needed data
        $apiKey = env('MAILGUN_SECRET', null);
        $token = $request->signature['token'];
        $timestamp = $request->signature['timestamp'];
        $signature = $request->signature['signature'];

        //check if the timestamp is fresh
        if (abs(time() - $timestamp) > 15)
            return false;

        //returns true if signature is valid
        return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
    }

    private function saveEvent(Request $request)
    {
        //get email
        $email = $this->getEmail($request);
        if(!$email)
            return response('Error: no E-mail found', 400)->header('Content-Type', 'text/plain');

        //save event
        EmailLogEvent::create([
            'messageId' => $email->id,
            'event' => $request->{'event-data'}['event'],
            'data' => json_encode($request->all()),
        ]);

        //return success
        return response('Success', 200)->header('Content-Type', 'text/plain');
    }

    private function getEmail(Request $request)
    {
        return EmailLog::select('id', 'messageId')
            ->where('messageId', strtok($request->{'event-data'}['message']['headers']['message-id'], '@'))
            ->first();
    }
}