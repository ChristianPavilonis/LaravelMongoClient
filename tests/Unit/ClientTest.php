<?php

namespace Tests\Unit;

use MongoClient\Client;
use Tests\TestCase;

class ClientTest extends TestCase
{

    /** @var Client */
    private $client;

    protected function setUp() : void
    {
        parent::setUp();
        $this->client = resolve('mongodb');
    }

    public function testConnection()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    /** @test */
    public function clientGet()
    {
       $this->assertInstanceOf(\MongoDb\Database::class, $this->client->sandbox);
    }

    /** @test */
    public function callMethod()
    {
        dd($this->client->dropDatabase('sandbox'));
    }



}
