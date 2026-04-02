<?php
use DevSphere\Controllers\OpenApiController;
use DevSphere\Controllers\ViewController;
use DevSphere\Controllers\UserController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return (function(App $app) {
	$app->group("/api", function(RouteCollectorProxy $group) {
		$group->get("", function ($req, $resp) {
			echo "Hello world";
			return $resp;
		});
		$group->get("/swagger", [OpenApiController::class, "swagger"]);
		$group->group("/user", function(RouteCollectorProxy $group) {
			$group->get("", [UserController::class, "getAll"]);
		});
	});

	$app->get("/", [ViewController::class, "displayHome"]);
});
