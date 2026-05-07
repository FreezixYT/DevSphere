<?php
use Slim\App;
use DevSphere\Controllers\ProjectController;
use DevSphere\Controllers\RoleController;
use DevSphere\Controllers\UserController;
use DevSphere\Middlewares\Auth;
use Slim\Interfaces\RouteCollectorProxyInterface as RouteCollectorProxy;

return function(App $app) 
{
	$app->get("/", [ProjectController::class, "showHome"]);
	$app->group("/project", function(RouteCollectorProxy $group) {
		$group->get("/{id}", [ProjectController::class, "showDetails"]);
	});
	$app->group("/user", function(RouteCollectorProxy $group) {
		$group->get("/{id}", [UserController::class, "showProfile"]);
	});

	$app->group("/role", function(RouteCollectorProxy $group) {
		$group->post("/{id}/request", [RoleController::class, "request"])->add(Auth::class);
	});

	$app->get("/login", [UserController::class, "showLogin"]);
	$app->post("/login", [UserController::class, "login"]);

	$app->get("/register", [UserController::class, "showRegister"]);
	$app->post("/register", [UserController::class, "register"]);

	$app->get("/logout", [UserController::class, "logout"]);
};