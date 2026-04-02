<?php
namespace DevSphere\Controllers;

use OpenApi\Attributes as OA;
use OpenApi\Generator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ViewController extends BaseController
{
    function displayHome(Request $req, Response $resp, Array $args) : Response
    {
        return $this->render("home.php", [
            "title" => "Home"
        ]);
    }

    function displayRegister(Request $req, Response $resp, Array $args) : Response
    {
        return $this->render("register.php", [
            "title" => "S'enregister"
        ]);
    }

    function displayLogin(Request $req, Response $resp, Array $args) : Response
    {
        return $this->render("login.php", [
            "title" => "Se connecter"
        ]);
    }
}