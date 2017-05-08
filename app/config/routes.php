<?php

use core\myRouter;

$router = new myRouter();
$router->removeExtraSlashes(true);
$router->notFound('error::notFound');

$router->addx('/','index::index','home');

$router->addx('/lists/{list:[0-9]+}','lists::show');
$router->addx('/books/{book:[0-9]+}','books::show');
$router->addx('/chapters/{chapter:[0-9]+}','chapters::show');

$router->addx('/comments','comments::index');
$router->addPost('/comments/addBy/{commentable_type}/{commentable_id:[0-9]+}','comments::add')->setMiddlewares(CommentsForm::class);
$router->addx('/comments/{comment:[0-9]+}/edit','comments::edit')->setMiddlewares([CommentsForm::class,\middlewares\setUrlBeforeMiddleware::class]);
$router->addx('/comments/{comment:[0-9]+}/delete','comments::delete')->setMiddlewares([\middlewares\setUrlBeforeMiddleware::class]);
return $router;
