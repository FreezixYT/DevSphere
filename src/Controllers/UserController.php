<?php
namespace DevSphere\Controllers;

use DevSphere\Models\Project;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use DevSphere\Models\User;
use DevSphere\Schemas\LoginSchema;
use DevSphere\Schemas\UpdateSchema;
use DevSphere\Schemas\RegisterSchema;

class UserController extends BaseController {
    
    function showLogin(Request $req, Response $resp) : Response {
        return $this->render("login.php", [
            "title" => "Login",
            "errors" => []
        ]);
    }

    function showRegister(Request $req, Response $resp) : Response {
        return $this->render("register.php", [
            "title" => "Register",
            "errors" => []
        ]);
    }
    
    function showProfile(Request $req, Response $resp, Array $args) : Response {
        $user = User::selectById((int)$args["id"]);
        return $this->render("profile.php", [
            "title" => "Profile",
            "user" => $user,
            "errors" => [],
            "projects" => Project::selectAllByUserId($user->id)
        ]);
    }

    public function login(Request $req, Response $resp) {
        $schema = new LoginSchema($_POST);
        $result = $schema->validate();
    
        if ($result === true) {
            $user = User::findByEmail($schema->email);
            if (!$user) {
                return $this->render("login.php", [
                    "title" => "Login",
                    "errors" => ["User not found"]
                ]);
            }
            if (password_verify($schema->password, $user->password)) {
                $_SESSION["user"] = $user;
                return $this->redirect("/");
            }
            else {
                return $this->render("login.php", [
                    "title" => "Login",
                    "errors" => ["Wrong password"]
                ]);
            }
        }
        else {
            return $this->render("login.php", [
                "title" => "Login",
                "errors" => $result
            ]);
        }
    }

    public function editProfile(Request $req, Response $resp, array $args) {
        $id = (int)$args["id"];
        if ($id !== $_SESSION["user"]->id)
            return $this->redirect("/");
        $schema = new UpdateSchema($_POST);
        $result = $schema->validate();

        if ($result === true) {
            $id = $_SESSION["user"]->id;
            User::updateUser($id, $schema);
            $user = User::getUser($id);
            return $this->redirect("/");
        }
        else {
            return $this->render("register.php", [
                "title" => "Register",
                "errors" => $result
            ]);
        }
    }

    public function register(Request $req, Response $resp) {
        $schema = new RegisterSchema($_POST);
        $result = $schema->validate();

        if ($result === true) {
            $status = User::checkEmail($schema);
            if ($status) {
                return $this->render("register.php", [
                    "title" => "Register",
                    "errors" => ["Email already used"]
                ]);
            }
            
            $id = User::createUser($schema);
            $user = User::getUser($id);
            $_SESSION["user"] = $user;
            return $this->redirect("/");
        }
        else {
            return $this->render("register.php", [
                "title" => "Register",
                "errors" => $result
            ]);
        }
    }

    public function logout(Request $req, Response $resp): Response {
        unset($_SESSION["user"]);
        return $this->redirect("/");
    }
}