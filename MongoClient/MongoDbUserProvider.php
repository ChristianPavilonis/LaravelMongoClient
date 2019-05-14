<?php

namespace MongoClient;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class MongoDbUserProvider implements UserProvider
{

    /** @var Database */
    private $db;
    /** @var \MongoDB\Collection */
    private $users;

    public function __construct()
    {
        $this->db = resolve('mongodb_database');
        $this->users = $this->db->users;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable | null
     */
    public function retrieveById($identifier)
    {
        $user = new User([]);

        $result = $this->users->find([$user->getAuthIdentifierName() => $identifier])->toArray()[0];

        $array = $this->deconstructBsonObject($result);

        return new User($array);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }

    /**
     * @param $result
     * @return array
     */
    private function deconstructBsonObject($result) : array
    {
        $array = [];

        foreach($result as $property => $value) {
            $array[$property] = $value;
        }

        return $array;
    }
}
