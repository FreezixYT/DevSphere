<?php
namespace DevSphere\Controllers;

use DateInterval;
use DateTime;
use DevSphere\Models\User;
use DevSphere\Schemas\LoginSchema;
use DevSphere\Schemas\RegisterSchema;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;



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
            $user = new User();
            static::generateJWT($user);
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
            
            $id = User::createUser($schema);
            $user = User::getUser($id);
            $jwt = $this->generateJWT($user);
            return $this->sendJSON(["jwt" => $jwt]);
        }
        else
        {
            return $this->sendErrors($result);
        }
    }
    private function generateJWT(User $user) {
        $key = $_ENV["JWT_KEY"] ?? 'FYCFg6JaPmRpicpoWsWovyvm0oN7jh4McCRtEMBxXxr';
        $today = new DateTime();
        $interval = DateInterval::createFromDateString('1 day');
        $payload = [
            'sub' => $user->id,
            'iat' => $today->getTimestamp(),
            'exp' => $today->add($interval)
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}