# Laravel Email Database Log

A simple database logger for all outgoing emails sent by Laravel website.
Forked from ShvetsGroup\LaravelEmailDatabaseLog.

For Laravel 5.8 - use 2.* versions
For Laravel 6 - use 3.* versions

# Installation

## Step 1: Composer

Laravel Email Database Log can be installed via [composer](http://getcomposer.org) by running this line in terminal:

```bash
composer require dmcbrn/laravel-email-database-log
```

## Step 2: Configuration

You can skip this step if your version of Laravel is 5.5 or above. Otherwise, you have to add the following to your config/app.php in the providers array:

```php
'providers' => [
    // ...
    Dmcbrn\LaravelEmailDatabaseLog\LaravelEmailDatabaseLogServiceProvider::class,
],
```

## Step 3: Migration

Now, run this in terminal:

```bash
php artisan migrate
```

## Step 4: Config

To publish config file run this in terminal:

```bash
php artisan vendor:publish --provider="Dmcbrn\LaravelEmailDatabaseLog\LaravelEmailDatabaseLogServiceProvider"
```

Config contains three parameters:

```php
//name of the folder where the attachments will be saved
'folder' => env('EMAIL_LOG_ATTACHMENT_FOLDER','email_log_attachments'),
//to prevent access to list of logged emails add a middleware
'access_middleware' => env('EMAIL_LOG_ACCESS_MIDDLEWARE',null),
//this parameter prefixes the routes for listing of logged emails
'routes_prefix' => env('EMAIL_LOG_ROUTES_PREFIX',''),
```

# Usage

After installation, any email sent by your website will be logged to `email_log` table in the site's database.

Any attachments will be saved in `storage/email_log_attachments` folder. The `email_log_attachments` can be changed by publishing the config file and changing the 'folder' value.

If you want to process the logged email or save/format some additional data on your system you can hook up to the `Dmcbrn\LaravelEmailDatabaseLog\LaravelEvents\EmailLogged` event via a Laravel listener:

https://laravel.com/docs/5.5/events#defining-listeners

Don't forget to register the event:

https://laravel.com/docs/5.5/events#registering-events-and-listeners

If you're using Laravel >=5.8.9 you can use `Event Discovery` instead:

https://laravel.com/docs/5.8/events#registering-events-and-listeners 

If using queues on your server you will need to restart the worker for the library to work:

```
Remember, queue workers are long-lived processes and store the booted application state in memory. 
As a result, they will not notice changes in your code base after they have been started. 
So, during your deployment process, be sure to restart your queue workers.


https://laravel.com/docs/5.5/queues#running-the-queue-worker
```

You can review sent emails using the following URI `/email-log`.

You can prefix this URI by adding something like `EMAIL_LOG_ROUTES_PREFIX=prefix/` to your .env file.

You can protect this URI using middleware by adding something like `EMAIL_LOG_ACCESS_MIDDLEWARE=auth` to your .env file.

## MailGun webhooks

You can use Mailgun webhooks to log webhook events. In your MailGun Webhooks section add:

```
https://example.com/email-log/webhooks/event
```

for all of the events. If you used a `prefix` in the config file then this should be reflected in the url:

```
https://example.com/your-prefix/email-log/webhooks/event
```
