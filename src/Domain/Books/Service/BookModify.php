<?php

namespace App\Domain\Books\Service;

use App\Domain\Books\Repository\BookModifyRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class BookModify
{
    /**
     * @var BookModifyRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param BookModifyRepository $repository The repository
     */
    public function __construct(BookModifyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     */
    public function modifyBook(array $data): int
    {
        // Input validation
        $this->validateNewBook($data);

        // Insert user
        $bookId = $this->repository->modifyBook($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $bookId;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateNewBook(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['livres_id'])) {
            $errors['genres_id'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
