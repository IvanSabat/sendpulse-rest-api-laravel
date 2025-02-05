# SendPulse Laravel

A service provider and facade to set up and use the SendPulse PHP library in Laravel.

## Installation

1. Install Package in a Laravel project:
```bash
composer require ivansabat/sendpulse-rest-api-laravel
```

2. Set Environment Variables in __.env__:
```dotenv
SENDPULSE_API_USER_ID=your_api_user_id
SENDPULSE_API_SECRET=your_api_secret
```

3. Publish the configuration file (create sendpulse.php in the config directory).
```php
php artisan vendor:publish --provider="IvanSabat\SendPulse\Providers\SendPulseServiceProvider"
```

## Usage

Use the Package in your Laravel application:

```php
use IvanSabat\Sendpulse\Facades\SendPulse;

$addressBooks = SendPulse::listAddressBooks();
```

```php
use IvanSabat\Sendpulse\Facades\SendPulse;

$sendPulse = new Sendpulse(
    config('sendpulse.api_user_id'),
    config('sendpulse.api_secret')
);
$addressBooks = $sendPulse->get('addressbooks');
```
