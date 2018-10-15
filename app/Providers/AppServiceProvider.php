<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\LogEntriesHandler;
use Log;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //add monolog log types into seperate log files
        $monolog = Log::getMonolog();
        foreach ($monolog->getHandlers() as $handler) {
            $handler->setLevel(Config::get('app.log_level'));
        }
        $bubble = false;
        $infoStreamHandler = new \Monolog\Handler\StreamHandler( storage_path("logs/info.log"), \Monolog\Logger::INFO, $bubble);
        $monolog->pushHandler($infoStreamHandler);

        $warningStreamHandler = new \Monolog\Handler\StreamHandler( storage_path("logs/warning.log"), \Monolog\Logger::WARNING, $bubble);
        $monolog->pushHandler($warningStreamHandler);

        //=======================================
        //add logentries.com online log viwer
        $logEntriesHandler = new LogEntriesHandler(env('LOGENTRIES_TOKEN', '2c757d15-672a-47d9-bce3-f5409980bfcb'));
        $log = $this->app['log']->getMonolog();
        $log->pushHandler($logEntriesHandler);
    }
}
