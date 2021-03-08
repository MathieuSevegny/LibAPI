<?php

namespace App\Midleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use App\Midleware\Repository\TokenValidater;


class BeforeEditingMidd
{
    private $tokenValidater;

    public function __construct(TokenValidater $tokenValidater)
    {
        $this->tokenValidater = $tokenValidater;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {

        $data = (array)$request->getParsedBody();

        $isOk = $this->tokenValidater->validate($data);

        if (!$isOk){
            $new_response = new \Slim\Psr7\Response();
            return $new_response->withStatus(403);
        }
        else{
            return $handler->handle($request);
        }
    }
}
