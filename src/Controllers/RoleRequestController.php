<?php
namespace DevSphere\Controllers;

use DevSphere\Enums\RoleRequestStatus;
use DevSphere\Models\RoleRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RoleRequestController extends BaseController {
    public function updateStatus(Request $req, Response $resp, array $args) {
        $userId = (int)$args["userId"];
        $roleId = (int)$args["roleId"];
        $option = $_POST["choice"];
        $request = RoleRequest::selectByUserAndRole($userId, $roleId);
        $request->update();
    }
}