<?php

namespace App\Domain\Books\Repository;

use PDO;

/**
 * Repository.
 */
class ShowABookRepository
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

    public function showABook($id) : array
    {

        $sql = "SELECT livres.titre, CONCAT(auteurs.prenom, ' ', auteurs.nom) AS auteur, genres.nom AS genre FROM livres
INNER JOIN livre_auteur ON livres.id = livre_auteur.livres_id
INNER JOIN auteurs ON livre_auteur.auteurs_id = auteurs.id
INNER JOIN genres ON genres.id = livres.genres_id WHERE livres.id = " . $id .";";

        $query = $this->connection->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}

