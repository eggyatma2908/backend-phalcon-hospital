<?php

$router = $di->getRouter();

$router->add("/api/v1/get", "API::get", ["GET"]);
$router->add("/api/v1/get/{id}", "API::getById", ["GET"]);
$router->add("/api/v1/post", "API::post", ["POST"]);
// $router->add("/api/v1/put/{id}", "API::put", ["PUT"]);
// $router->add("/api/v1/delete/{id}", "API::delete", ["DELETE"]);

$router->handle($_SERVER['REQUEST_URI']);
