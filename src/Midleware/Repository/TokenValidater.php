<?php


namespace App\Midleware\Repository;

use PDO;

class TokenValidater
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function validate(array $args): bool
    {

        $username = base64_decode($args['username']);
        $password = base64_decode($args['password']);

        $sql = "SELECT password as password FROM users WHERE username = :username ;";

        $query = $this->connection->prepare($sql);
        $query->execute(array('username' => $username));

        $results = $query->fetch();

        return password_verify($password, $results['password']);
    }
}
