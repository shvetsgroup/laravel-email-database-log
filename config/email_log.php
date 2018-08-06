<?php

return [
    'folder' => env('EMAIL_LOG_ATTACHMENT_FOLDER','email_log_attachments'),
    'access_middleware' => env('EMAIL_LOG_ACCESS_MIDDLEWARE',null),
    'routes_prefix' => env('EMAIL_LOG_ROUTES_PREFIX',''),
];
