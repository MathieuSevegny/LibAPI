<?php

namespace App\Domain\Books\Repository;

use PDO;

/**
 * Repository.
 */
class DeleteABookRepository
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

    public function deleteABook($id) : array
    {

        $sql = "DELETE FROM livre_auteur WHERE livres_id = " . $id .";";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $sql = "DELETE FROM livres WHERE id = " . $id .";";

        $query = $this->connection->prepare($sql);
        if ($query->execute()){
            $return["result"] = "ok";
        }
        else{
            $return["result"] = "error";
        }

        return $return;
    }
}

