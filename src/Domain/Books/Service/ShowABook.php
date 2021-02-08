<?php

namespace App\Domain\Books\Service;

use App\Domain\Books\Repository\ShowABookRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class ShowABook
{
    /**
     * @var ShowABookRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ShowABookRepository $repository The repository
     */
    public function __construct(ShowABookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showingBook($id) : string
    {
        return json_encode($this->repository->showABook($id));
    }

}
