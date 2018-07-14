# Laravel Email Database Log

A simple database logger for all outgoing emails sent by Laravel website.
Forked from ShvetsGroup\LaravelEmailDatabaseLog.

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
php artisan vendor:publish --provider="DmcBrn\LaravelEmailDatabaseLog\LaravelEmailDatabaseLogServiceProvider"
```

Config contains only one key at the moment `folder` and this is the name of the folder where the attachments will be saved.

# Usage

After installation, any email sent by your website will be logged to `email_log` table in the site's database.

Any attachments will be saved in `storage/email_log_attachments` folder. The `email_log_attachments` can be changed by publishing the config file and changing the 'folder' value.

If using queues on your server you will need to restart the worker for the library to work:

```
Remember, queue workers are long-lived processes and store the booted application state in memory. 
As a result, they will not notice changes in your code base after they have been started. 
So, during your deployment process, be sure to restart your queue workers.


https://laravel.com/docs/5.6/queues#running-the-queue-worker
```
