<?php

return [
    App\Providers\AppServiceProvider::class,


    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,


    // ✅ Add Fortify
    App\Providers\FortifyServiceProvider::class,
];
