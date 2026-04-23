<?php
namespace DevSphere\Controllers;

use DevSphere\Models\User;
use DevSphere\Schemas\LoginSchema;

class UserController extends BaseController {
    
    public function getAll($req, $resp) {
        $users = User::selectAll();
        return $this->sendJSON($users);
    }

    public function login($req, $resp)
    {
        $data = $this->getBody($req);
        $schema = new LoginSchema($data);
        $result = $schema->validate();
        if($result === true)
        {
            //crée user
        }
        else
        {
            return $this->sendErrors($result);
        }
    }
}