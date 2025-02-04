<?php

namespace IvanSabat\SendPulse\Facades;

use Illuminate\Support\Facades\Facade;

class SendPulse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sendpulse';
    }
}
