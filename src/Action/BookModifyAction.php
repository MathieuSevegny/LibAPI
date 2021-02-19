<?php

namespace App\Action;

use App\Domain\Books\Service\BookModify;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class BookModifyAction
{
    private $bookModify;

    public function __construct(BookModify $bookModify)
    {
        $this->bookModify = $bookModify;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $bookId = $this->bookModify->modifyBook($data);

        // Transform the result into the JSON representation
        $result = [
            'book_id' => $bookId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
