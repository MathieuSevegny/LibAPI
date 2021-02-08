<?php

namespace App\Action;

use App\Domain\Books\Service\ShowABook;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ShowABookAction
{
    private $showBook;

    public function __construct(ShowABook $showBook)
    {
        $this->showBook = $showBook;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $bookId = $request->getAttribute('id',1);
        // Invoke the Domain with inputs and retain the result
        $result = $this->showBook->showingBook($bookId);


        // Build the HTTP response
        $response->getBody()->write((string)$result);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
