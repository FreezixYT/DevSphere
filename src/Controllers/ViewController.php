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

    function displayProject(Request $req, Response $resp, array $args) : Response
    {
        return $this->render("projectDetails.php", [
            "title" => "Project - Details",
            "projectId" => $args["id"]
        ]);
    }
}