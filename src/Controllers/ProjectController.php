<?php
namespace DevSphere\Controllers;

use DevSphere\Models\Project;
use DevSphere\Models\ProjectTag;
use DevSphere\Models\Role;
use DevSphere\Models\Tag;
use DevSphere\Schemas\CreateProject;
use DevSphere\Schemas\CreateRole;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProjectController extends BaseController {

    public function showDetails(Request $req, Response $resp, array $args) {
        $id = (int)$args["id"];
        $project = Project::selectById($id);
        if ($project == null)
        {
            return $this->redirect("/");
        }
        return $this->render("projectDetails.php", ["project" => $project]);
    }

    public function createRole(Request $req, Response $resp, array $args) {
        $projectId = $args['id'];
        $schemas = new CreateRole($_POST);
        $project = Role::create($projectId, $schemas->roleName, $schemas->roleDescription);
        $id = $project->insert();

        return $this->redirect("/project/$projectId");
    }

    public function showHome(Request $req, Response $resp, array $args) {

        

        if ($_GET['q'] !== null)
        {
            $projects = Project::search([
                "name" => $_GET['q']
            ]);
            if ($_GET['tags'])
            {
                $new = [];
                foreach($projects as  $project) {
                    $tags = array_filter($project->tags, fn($t) => in_array($t->id, $_GET["tags"]));
                    if (count($tags) > 0)
                        $new[] = $project;
                }
                $projects = $new;
            }
        }
        else
        {
            $projects = Project::selectAll();
        }

        $tags = Tag::selectAll();

        return $this->render("home.php", ["projects" => $projects, "tags" => $tags]);
    }

    public function showCreate(Request $req, Response $resp, array $args) {
        return $this->render("createProject.php", ["errors" => [], "tags" => Tag::selectAll()]);
    }

    public function create(Request $req, Response $resp, array $args) {
        $schemas = new CreateProject($_POST);
        $project = Project::create($schemas->name, $schemas->description, $_SESSION["user"]->id);
        $id = $project->insert();
        $tags = [];

        foreach ($schemas->tags as $tag) {
            $tag = Tag::selectById((int)$tag);
            if ($tag === null)
                return $this->render("createProject.php", ["errors" => ["You gave a tag that doesn't exist"], "tags" => Tag::selectAll()]);
            $tags[] = $tag;
        }
        
        foreach ($tags as $tag) {
            ProjectTag::create($id, $tag->id)->insert();
        }
        return $this->redirect("/");
    }

    public function delete(Request $req, Response $resp, array $args) {
        $project = Project::selectById((int)$args["id"]);
        $project->delete();
        $id = $_SESSION["user"]->id;
        return $this->redirect("/user/$id");
    }
}