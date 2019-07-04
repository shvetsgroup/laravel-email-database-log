<?php

namespace Dmcbrn\LaravelEmailDatabaseLog;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_log';

    /**
     * Disable timestamps for the model.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'from',
        'to',
        'cc',
        'bcc',
        'subject',
        'body',
        'headers',
        'attachments',
        'messageId',
        'mail_driver',
    ];

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];

    /**
     * The Events belonging to this Email.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('Dmcbrn\LaravelEmailDatabaseLog\EmailLogEvent','messageId','messageId');
    }
}
