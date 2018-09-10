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

    public function webhookEvents(Request $request)
    {
        //verify
        $verified = $this->verify(env('MAILGUN_SECRET', null), $request->signature['token'], $request->signature['timestamp'], $request->signature['signature']);
        if(!$verified)
            return response('Error', 400)->header('Content-Type', 'text/plain');

        //find email
        $email = EmailLog::select('id','messageId')->where('messageId',strtok($request->{'event-data'}['message']['headers']['message-id'],'@'))->first();
        if(!$email)
            return response('Error', 400)->header('Content-Type', 'text/plain');

        //create event
        EmailLogEvent::create([
            'messageId' => $email->id,
            'event' => $request->{'event-data'}['event'],
            'data' => json_encode($request->all()),
        ]);

        //return success
        return response('Success', 200)->header('Content-Type', 'text/plain');
    }

    private function verify($apiKey, $token, $timestamp, $signature)
    {
        //check if the timestamp is fresh
        if (abs(time() - $timestamp) > 15) {
            return false;
        }

        //returns true if signature is valid
        return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
    }
}