<?php

namespace ShvetsGroup\LaravelEmailDatabaseLog;

use DB;

class EmailLogger
{
    /**
     * Handle the event.
     *
     * @param \Swift_Message $message
     * @return void
     */
    public function handle(\Swift_Message $message)
    {
        DB::table('email_log')->insert([
            'date' => date('Y-m-d H:i:s'),
            'to' => $message->getHeaders()->get('To')->getFieldBody(),
            'subject' => $message->getHeaders()->get('Subject')->getFieldBody(),
            'body' => $this->getMimeEntityString($message),
        ]);
    }

    /**
     * Get a loggable string out of a Swiftmailer entity.
     *
     * @param  \Swift_Mime_MimeEntity $entity
     * @return string
     */
    protected function getMimeEntityString(\Swift_Mime_MimeEntity $entity)
    {
        $string = (string) $entity->getHeaders().PHP_EOL.$entity->getBody();

        foreach ($entity->getChildren() as $children) {
            $string .= PHP_EOL.PHP_EOL.$this->getMimeEntityString($children);
        }

        return $string;
    }
}