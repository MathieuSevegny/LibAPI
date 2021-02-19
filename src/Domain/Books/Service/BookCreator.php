<?php

namespace App\Domain\Books\Service;

use App\Domain\Books\Repository\BookCreatorRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class BookCreator
{
    /**
     * @var BookCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param BookCreatorRepository $repository The repository
     */
    public function __construct(BookCreatorRepository $repository)
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
    public function createBook(array $data): int
    {
        // Input validation
        $this->validateNewBook($data);

        // Insert user
        $bookId = $this->repository->createBook($data);

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

        if (empty($data['genres_id'])) {
            $errors['genres_id'] = 'Input required';
        }
        if (empty($data['titre'])) {
            $errors['titre'] = 'Input required';
        }
        if (empty($data['isbn'])) {
            $errors['isbn'] = 'Input required';
        }
        if (empty($data['auteurs_id'])) {
            $errors['auteurs_id'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
