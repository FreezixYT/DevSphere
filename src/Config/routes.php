<?php
use Slim\App;
use DevSphere\Controllers\ProjectController;
use DevSphere\Controllers\UserController;
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

	$app->get("/login", [UserController::class, "showLogin"]);
	$app->get("/register", [UserController::class, "showRegister"]);
	$app->post("/login", [UserController::class, "login"]);
	$app->post("/register", [UserController::class, "register"]);
};