<?php

namespace App\Domain\Books\Service;

use App\Domain\Books\Repository\ShowABookTitleRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class ShowABookTitle
{
    /**
     * @var ShowABookTitleRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ShowABookTitleRepository $repository The repository
     */
    public function __construct(ShowABookTitleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showingBook($titre) : string
    {
        return json_encode($this->repository->showABook($titre));
    }

}
