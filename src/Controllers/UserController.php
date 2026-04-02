<?php
namespace DevSphere\Controllers;

use DevSphere\Models\User;

class UserController extends BaseController {
    
    public function getAll($req, $resp) {
        $users = User::selectAll();
        return $this->sendJSON($users);
    }
}