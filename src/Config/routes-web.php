<?php
use Slim\App;
use DevSphere\Controllers\OpenApiController;
use DevSphere\Controllers\ViewController;
use DevSphere\Controllers\UserController;

return function(App $app) 
{
	$app->get("/", [ViewController::class, "displayHome"]);
	$app->get("/project/{id}", [ViewController::class, "displayProject"]);
	$app->get("/login", [ViewController::class, "displayLogin"]);
	$app->get("/register", [ViewController::class, "displayRegister"]);
	$app->get("/profil", [ViewController::class, "displayProfil"]);
};