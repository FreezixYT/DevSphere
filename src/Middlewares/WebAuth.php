<?php
namespace DevSphere\Middlewares;

use DevSphere\Enums\HTTPStatus;
use DevSphere\Models\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class WebAuth implements MiddlewareInterface
{
    public function __construct(private ResponseFactoryInterface $respFact)
    { }

    public function process(Request $request, RequestHandler $handler): Response {
		$token = $this->getToken();
        $response = $this->respFact->createResponse();
        $body = $response->getBody();
        if ($token === false) {
            $body->write(json_encode(["errors" => "You must provide a JWT token to access this route"], HTTPStatus::UNAUTHORIZED->value));
            return $response->withBody($body);
        }
        $key = $_ENV["JWT_KEY"] ?? 'FYCFg6JaPmRpicpoWsWovyvm0oN7jh4McCRtEMBxXxr';
        $key = new Key($key, 'HS256');
        try {
            $headers = new \stdClass();
            $infos = (array) JWT::decode($token, $key, $headers);
            $userId = $infos["sub"];
            $user = User::selectById($userId);
            if ($user === false)
                throw new \Exception();
            $request->withAttribute("user", $user);
            $response = $handler->handle($request);
            return $response;
        } catch (ExpiredException) {
            $body->write(json_encode(["errors" => "Expired JWT token"], HTTPStatus::UNAUTHORIZED->value));
            return $response->withBody($body);
        }
        catch (\Exception) {
            $body->write(json_encode(["errors" => "Invalid JWT token"], HTTPStatus::UNAUTHORIZED->value));
            return $response->withBody($body);
        } 
	}

	protected static function getToken(): string|false {
		if (isset($_SESSION["JWT"]))
            return $_SESSION["JWT"];
        return false;
	}
}