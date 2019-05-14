<?php

namespace MongoClient;

/**
 * @method \MongoDB\Driver\Cursor command($command, $options = [])
 * @method array | object createCollection($collectionName, array $options = [])
 * @method array | object drop(array $options = [])
 * @method array | object dropCollection($collectionName, array $options = [])
 * @method string getDatabaseName()
 * @method \MongoDB\Driver\Manager getManager()
 * @method \MongoDB\Driver\ReadConcern getReadConcern()
 * @method \MongoDB\Driver\ReadPreference getReadPreference()
 * @method array getTypeMap()
 * @method \MongoDB\Driver\WriteConcern getWriteConcern()
 * @method \MongoDB\Model\CollectionInfoIterator listCollections(array $options = [])
 * @method modifyCollection($collectionName, array $collectionOptions, array $options = [])
 * @method \MongoDB\Collection selectCollection($collectionName, array $options = [])
 * @method \MongoDB\GridFS\Bucket selectGridFSBucket(array $options = [])
 * @method \MongoDB\ChangeStream watch(array $pipeline = [], array $options = [])
 * @method \MongoDB\Database withOptions(array $options = [])
 */
class Database
{

    /** @var Client */
    private $client;
    /** @var string */
    private $name;
    private $db;

    public function __construct()
    {
        $this->client = resolve('mongodb');
        $this->name   = env('DB_DATABASE');
        $this->db     = $this->client->{$this->name};
    }

    public function __get($name)
    {
        return $this->db->$name;
    }

    public function __call($name, $arguments)
    {
        if(in_array($name, get_class_methods($this->db))) {
            return call_user_func_array([$this->db, $name], $arguments);
        }
    }
}
