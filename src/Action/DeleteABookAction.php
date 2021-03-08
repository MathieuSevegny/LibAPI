<?php

namespace App\Action;

use App\Domain\Books\Service\DeleteABook;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteABookAction
{
    private $deleteBook;

    public function __construct(DeleteABook $deleteBook)
    {
        $this->deleteBook = $deleteBook;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $bookId = $request->getAttribute('id',1);
        // Invoke the Domain with inputs and retain the result
        $result = $this->deleteBook->deleteABook($bookId);


        // Build the HTTP response
        $response->getBody()->write((string)$result);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
