<?php

namespace App\Action;

use App\Domain\Books\Service\ShowABookTitle;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ShowABookTitleAction
{
    private $showBook;

    public function __construct(ShowABookTitle $showBook)
    {
        $this->showBook = $showBook;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $bookTitre = $request->getAttribute('title',"");
        // Invoke the Domain with inputs and retain the result
        $result = $this->showBook->showingBook($bookTitre);

        // Build the HTTP response
        $response->getBody()->write((string)$result);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
