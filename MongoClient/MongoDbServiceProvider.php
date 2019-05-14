<?php

namespace MongoClient;

use Illuminate\Support\ServiceProvider;

class MongoDbServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('mongodb', Client::class);
        $this->app->bind('mongodb_database', Database::class);
    }
}
