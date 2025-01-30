<?php

namespace Modules\DeliveryTimeSlot\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        /**
         * Backend
         */
        'Modules\DeliveryTimeSlot\Events\Backend\NewCreated' => [
            'Modules\DeliveryTimeSlot\Listeners\Backend\NewCreated\UpdateAllOnNewCreated',
        ],
        
        /**
         * Frontend
         */
    ];
}
