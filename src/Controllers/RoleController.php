<?php
namespace DevSphere\Controllers;

use DevSphere\Models\Request as RoleRequest;
use DevSphere\Models\Role;
use DevSphere\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RoleController extends BaseController {
    public function request(Request $req, Response $resp, array $args): Response {
        $id = (int)$args["id"];
        /** @var User $user */
        $user = $req->getAttribute("user");
        $role = Role::selectById($id);
        $body = $this->getBody($req);
        $request = RoleRequest::insert($user->id, $role->id, $body["message"]);
        return $this->sendJSON($request);
    }

    public function getById(Request $req, Response $resp, array $args): Response {
        $id = (int)$args["id"];
        $role = Role::selectById($id);
        return $this->sendJSON($role);
    }
}