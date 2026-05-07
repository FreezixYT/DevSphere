<?php
namespace DevSphere\Middlewares;

use Psr\Http\Message\ResponseFactoryInterface as ResponseFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;

use DevSphere\Enums\HTTPStatus;
use DevSphere\Models\User;

class Auth implements MiddlewareInterface
{
    public function __construct(private ResponseFactory $respFact)
    { }

    public function process(Request $request, RequestHandler $handler): Response {
        $user = $_SESSION["user"] ?? null;
        $response = $this->respFact->createResponse(HTTPStatus::MOVED_PERMANENTLY->value);
        if (!($user instanceof User))
            return $response->withHeader("Location", "/login");
        $request = $request->withAttribute("user", $user);
        $response = $handler->handle($request);
        return $response;
	}
}