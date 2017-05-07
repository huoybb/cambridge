<?php

use core\myRouter;
use middlewares\setUrlBeforeMiddleware;

$router = new myRouter();
$router->removeExtraSlashes(true);
$router->notFound('error::notFound');

$router->addx('/','index::index','home');

return $router;
