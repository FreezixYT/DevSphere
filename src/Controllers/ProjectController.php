<?php
namespace DevSphere\Controllers;

use DevSphere\Models\Project;
use DevSphere\Models\Role;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProjectController extends BaseController {

    public function showDetails(Request $req, Response $resp, array $args) {
        $id = (int)$args["id"];
        $project = Project::selectById($id);
        return $this->render("projectDetails.php", ["project" => $project]);
    }

    public function showHome(Request $req, Response $resp, array $args) {
        $projects = Project::selectAll();
        return $this->render("home.php", ["projects" => $projects]);
    }
}