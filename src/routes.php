<?php
use DevSphere\Controllers\OpenApiController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return (function(App $app) {
	$app->group("/api", function(RouteCollectorProxy $group) {
		$group->get("", function ($req, $resp) {
			echo "Hello world";
			return $resp;
		});
		$group->get("/swagger", [OpenApiController::class, "swagger"]);
	});
});
