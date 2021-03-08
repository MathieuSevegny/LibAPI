<?php

namespace App\Domain\Books\Service;

use App\Domain\Books\Repository\DeleteABookRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class DeleteABook
{
    /**
     * @var DeleteABookRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param DeleteABookRepository $repository The repository
     */
    public function __construct(DeleteABookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteABook($id) : string
    {
        return json_encode($this->repository->deleteABook($id));
    }

}
