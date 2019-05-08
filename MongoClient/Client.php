<?php

namespace MongoClient;

use MongoDB\Client as MongoDbClient;

/**
 * @method dropDatabase($databaseName, array $options = [])
 * @method getManager()
 * @method getReadConcern()
 * @method getReadPreference()
 * @method getTypeMap()
 * @method getWriteConcern()
 * @method listDatabases(array $options = [])
 * @method selectCollection($databaseName, $collectionName, array $options = [])
 * @method selectDatabase($databaseName, array $options = [])
 * @method startSession(array $options = [])
 * @method watch(array $pipeline = [], array $options = [])
 */
class Client
{
    protected $client;

    public function __construct()
    {
        $config = config('database')['connections']['mongodb'];
        $this->client = new MongoDbClient($config['dsn']);
    }

    /**
     * @param $name
     * @return \MongoDB\Database
     */
    public function __get($name)
    {
        return $this->client->$name;
    }

    public function __call($name, $arguments)
    {
        if(in_array($name, get_class_methods($this->client))) {
            return call_user_func_array([$this->client, $name], $arguments);
        }
    }
}
