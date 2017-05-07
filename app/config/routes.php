<?php

use core\myRouter;
use middlewares\setUrlBeforeMiddleware;

$router = new myRouter();
$router->removeExtraSlashes(true);
$router->notFound('error::notFound');

$router->addx('/','index::index','home');

$router->addx('/lists/{list:[0-9]+}','lists::show');
$router->addx('/books/{book:[0-9]+}','books::show');
return $router;
