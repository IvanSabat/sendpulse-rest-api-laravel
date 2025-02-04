# SendPulse Laravel

A service provider and facade to set up and use the SendPulse PHP library in Laravel.

## Installation

Install Package in a Laravel project:
```bash
composer require ivansabat/sendpulse-rest-api-laravel
```

Set Environment Variables in __.env__:
```dotenv
SENDPULSE_API_USER_ID=your_api_user_id
SENDPULSE_API_SECRET=your_api_secret
```

[//]: # (- [ ] Register the facade in the __config/app.php__ file in the aliases array:)

[//]: # (```php)

[//]: # ('SendPulse' => IvanSabat\Sendpulse\Facades\SendPulse::class,)

[//]: # (```)

## Usage

Use the Package in your Laravel application:

```php
use IvanSabat\Sendpulse\Facades\SendPulse;

$addressBooks = SendPulse::getAddressBooks();
```
