<?php

namespace Tests\Unit;

use MongoDB\Collection;
use MongoClient\Database;
use Tests\TestCase;

class DatabaseTest extends TestCase
{

    /** @var Database */
    private $db;

    protected function setUp() : void
    {
        parent::setUp();
        $this->db = resolve('mongodb_database');
    }

    /** @test */
    public function dbGet()
    {
        $this->assertInstanceOf(Collection::class, $this->db->users);
    }

    /** @test */
    public function callMethod()
    {
        $name = $this->db->getDatabaseName();

        $this->assertEquals('sandbox', $name);
    }






}
