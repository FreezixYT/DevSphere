<?php
namespace DevSphere\Controllers;

use DevSphere\Models\RoleRequest;
use DevSphere\Models\Role;
use DevSphere\Models\User;
use DevSphere\Schemas\RoleRequestSchema;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RoleController extends BaseController {
    public function request(Request $req, Response $resp, array $args): Response {
        $id = (int)$args["id"];
        $role = Role::selectById($id);
        if ($role === false)
            return $this->redirect("/");
        /** @var User $user */
        $schema = new RoleRequestSchema($_POST);
        $result = $schema->validate();
        if (is_array($result))
            return $this->redirect("/project/$role->projectId");
        $user = $req->getAttribute("user");
        $request = RoleRequest::selectByUserAndRole($user->id, $role->id);
        if ($request !== false)
            return $this->redirect("/project/$role->projectId");
        $request = RoleRequest::insert($user->id, $role->id, $schema->message);
        return $this->redirect("/project/$role->projectId");
    }
}