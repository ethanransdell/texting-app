<?php

namespace TextMessaging;

use Exception;
use Illuminate\Support\ServiceProvider;

class TextMessagingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/text-messaging.php' => config_path('text-messaging.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->singleton(TextMessagingInterface::class, function () {
            switch (config('text-messaging.default')) {
                case 'twilio':

                    return new TwilioTextMessaging(
                        config('text-messaging.connections.twilio.sid'),
                        config('text-messaging.connections.twilio.token'),
                        config('text-messaging.connections.twilio.from'),
                    );

                    break;
                default:
                    throw new Exception('No text messaging service specified');
            }
        });
    }
}
