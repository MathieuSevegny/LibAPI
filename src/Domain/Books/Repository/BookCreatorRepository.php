<?php

namespace App\Domain\Books\Repository;

use PDO;

/**
 * Repository.
 */
class BookCreatorRepository
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

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function createBook(array $book): int
    {
        $row = [
            'genres_id' => $book['genres_id'],
            'titre' => $book['titre'],
            'isbn' => $book['isbn'],
        ];


        $sql = "INSERT INTO livres SET 
                genres_id=:genres_id, 
                titre=:titre, 
                isbn=:isbn;";

        $sqldeux = "INSERT INTO livre_auteur SET 
                auteurs_id=:auteurs_id, 
                livres_id=:livres_id;";

        $this->connection->prepare($sql)->execute($row);

        $bookId = (int)$this->connection->lastInsertId();

        $rowdeux = [
            'auteurs_id' => $book['auteurs_id'],
            'livres_id' => $bookId,
        ];

        $this->connection->prepare($sqldeux)->execute($rowdeux);

        return $bookId;
    }
}

