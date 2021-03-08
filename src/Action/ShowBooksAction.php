<?php

namespace App\Action;

use App\Domain\Books\Service\ShowBooks;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ShowBooksAction
{
    private $showBooks;

    public function __construct(ShowBooks $showBooks)
    {
        $this->showBooks = $showBooks;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Invoke the Domain with inputs and retain the result
        $result = $this->showBooks->showingBooks();


        // Build the HTTP response
        $response->getBody()->write((string)$result);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
