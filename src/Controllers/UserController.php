<?php
namespace DevSphere\Controllers;

use DevSphere\Models\User;
use DevSphere\Schemas\LoginSchema;
use DevSphere\Schemas\RegisterSchema;

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

    public function register($req, $resp)
    {
        $data = $this->getBody($req);
        $schema = new RegisterSchema($data);
        $result = $schema->validate();
        if ($result === true)
        {
            $user = new User();
            $user->cre

        }
        else
        {
            return $this->sendErrors($result);
        }
    }
}