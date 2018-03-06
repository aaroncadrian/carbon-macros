<?php

namespace AaronAdrian\CarbonMacros;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class CarbonMacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!Carbon::hasMacro('toStartOfHour'))
        {
            Carbon::macro('toStartOfHour', function() {
                return $this->copy()->setTime($this->hour, 0, 0, 0);
            });
        }

        if(!Carbon::hasMacro('toStartOfMinute'))
        {
            Carbon::macro('toStartOfMinute', function() {
                return $this->copy()->setTime($this->hour, $this->minute, 0, 0);
            });
        }

        if(!Carbon::hasMacro('toTimestamp'))
        {
            Carbon::macro('toTimestamp', function() {
                return $this->format(config('carbon.formats.timestamp', 'H:i:00'));
            });
        }

        $this->publishes([
            __DIR__.'/carbon.php' => config_path('carbon.php'),
        ], 'carbon');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/carbon.php', 'carbon');
    }
}
