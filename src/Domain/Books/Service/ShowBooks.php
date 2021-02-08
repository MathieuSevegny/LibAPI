<?php

namespace App\Domain\Books\Service;

use App\Domain\Books\Repository\ShowBooksRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class ShowBooks
{
    /**
     * @var ShowBooksRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ShowBooksRepository $repository The repository
     */
    public function __construct(ShowBooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showingBooks() : string
    {
        return json_encode($this->repository->showBooks());
    }

}
