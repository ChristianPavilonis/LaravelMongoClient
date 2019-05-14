<?php

namespace Tests\Unit;

use MongoClient\Database;
use MongoClient\MongoDbUserProvider;
use MongoClient\User;
use Tests\TestCase;

class MongoDbUserProviderTest extends TestCase
{

    /** @var Database */
    private $db;
    private $users;
    /** @var MongoDbUserProvider */
    private $provider;
    private $userId;

    protected function setUp() : void
    {
        parent::setUp();
        $this->db     = resolve('mongodb_database');
        $this->users  = $this->db->users;
        $this->userId = $this->users->insertOne(['email' => 'email@example.com', 'name' => 'christian'])
                                    ->getInsertedId();
        $this->provider = new MongoDbUserProvider();
    }

    /** @test */
    public function retrieveById_ReturnsUser()
    {
        $user = $this->provider->retrieveById($this->userId);

        $this->assertInstanceOf(User::class, $user);
    }

}
