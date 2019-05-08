<?php

namespace MongoClient;


use Carbon\Laravel\ServiceProvider;

class MongoDbServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('mongodb', Client::class);
    }
}
