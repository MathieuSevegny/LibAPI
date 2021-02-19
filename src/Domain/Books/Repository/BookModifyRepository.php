<?php

namespace App\Domain\Books\Repository;

use PDO;

/**
 * Repository.
 */
class BookModifyRepository
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
     * @param array $book The user
     *
     * @return int The new ID
     */
    public function modifyBook(array $book): int
    {
        $sql = "UPDATE livres SET";

        $row = [
            'livres_id' => $book['livres_id'],
        ];

        if (!empty($book['genres_id'])) {
            $row['genres_id'] = $book['genres_id'];
            $sql .= " genres_id=:genres_id,";
        }
        if (!empty($book['titre'])) {
            $row['titre'] = $book['titre'];
            $sql .= " titre=:titre,";
        }
        if (!empty($book['isbn'])) {
            $row['isbn'] = $book['isbn'];
            $sql .= " isbn=:isbn,";
        }



        $sql = substr($sql, 0, -1);

        $sql .= " WHERE id = :livres_id;";

        if (!empty($book['genres_id']) || !empty($book['titre']) || !empty($book['isbn'])){
            $this->connection->prepare($sql)->execute($row);
        }


        if (!empty($book['auteurs_id'])) {
            $row['auteurs_id'] = $book['auteurs_id'];

            $sqldeux = "UPDATE livre_auteur SET 
                auteurs_id=:auteurs_id WHERE livres_id = :livres_id;";

            $rowdeux = [
                'auteurs_id' => $book['auteurs_id'],
                'livres_id' => $book['livres_id'],
            ];
            $this->connection->prepare($sqldeux)->execute($rowdeux);

        }





        return $book['livres_id'];
    }
}

