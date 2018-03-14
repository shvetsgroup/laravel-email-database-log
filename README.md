# Laravel Email Database Log

A simple database logger for all outgoing emails sent by Laravel website.

# Installation

## Step 1: Composer

Laravel Email Database Log can be installed via [composer](http://getcomposer.org) by running this line in terminal:

```bash
composer require shvetsgroup/laravel-email-database-log
```

## Step 2: Configuration

You can skip this step if your version of Laravel is 5.5 or above. Otherwise, you have to add the following to your config/app.php in the providers array:

```json
{
    "require": {
        "shvetsgroup/laravel-email-database-log": "*"
    }
}
```

Next add the service provider and the alias to `app/config/app`.

```php
'providers' => [
    // ...
    ShvetsGroup\LaravelEmailDatabaseLog\LaravelEmailDatabaseLogServiceProvider::class,
],
```

## Step 3: Migration

Now, run this in terminal:

```bash
php artisan migrate
```

# Usage

After installation, any email sent by your website will be logged to `email_log` table in the site's database.
