<?php
use Slim\App;
use DevSphere\Controllers\OpenApiController;
use DevSphere\Controllers\UserController;
use DevSphere\Controllers\ProjectController;
use Slim\Routing\RouteCollectorProxy;

return function(App $app) 
{
	$app->group("/api", function(RouteCollectorProxy $group) {
		$group->get("/swagger", [OpenApiController::class, "swagger"]);
		$group->group("/user", function(RouteCollectorProxy $group) {
			$group->get("", [UserController::class, "getAll"]);
		});
		$group->group("/project", function(RouteCollectorProxy $group) {
			$group->get("", [ProjectController::class, "getAll"]);
		});
	});
};

