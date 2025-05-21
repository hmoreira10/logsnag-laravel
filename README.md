
# LogSnag Logger for Laravel

A custom Laravel logging channel that sends logs directly to the LogSnag API via HTTP using Monolog.

---

## Description

This package provides an easy way to integrate Laravel's logging system with [LogSnag](https://logsnag.com/), allowing you to send structured log events directly to your LogSnag project. It leverages Monolog's custom handlers and Laravel's logging channels for seamless integration.

---

## Installation

Install the package via Composer:

```bash
composer require hmoreira10/logsnag-logger:dev-main
```

---

## Configuration

Add the custom log channel to your `config/logging.php` file:

```php
'channels' => [
    // other channels...

    'logsnag-your-channel' => [
        'driver' => 'custom',
        'via' => LogSnag\Logger\LogSnagLogger::class,
        'level' => 'info',
        'token' => env('LOGSNAG_TOKEN'),
        'project' => env('LOGSNAG_PROJECT'),
        'channel' => 'your-channel'
    ],
],
```

Then add the required environment variables to your `.env` file:

```env
LOGSNAG_TOKEN=your-logsnag-api-token
LOGSNAG_PROJECT=your-logsnag-project
```

---

## Usage

Use the custom log channel in your Laravel application like this:

```php
use Illuminate\Support\Facades\Log;

Log::channel('logsnag')->info('Important event happened', [
    'notify' => false
    'icon' => '💰',
]);
```

---

## Notes

- Logs are sent synchronously.
- Customize `notify`, `channel`, and `icon` via context.
- Requires Laravel 10+ and PHP 8.1+.

---

## License

MIT License
