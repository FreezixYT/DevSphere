<?php
namespace DevSphere\Controllers;

use DevSphere\Models\Project;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProjectController extends BaseController {
    public function getAll(Request $req, Response $resp) {
        $projects = Project::selectAll();
        return $this->sendJSON($projects);
    }
    public function getById(Request $req, Response $resp, array $args) {
        $id = (int)$args["id"];
        $project = Project::selectById($id);
        return $this->sendJSON($project);
    }
}