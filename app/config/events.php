<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 18:38
 */
$eventsManager = new \core\myEventsManager();
$eventsManager->register($eventsManager->getEventPrefix(),[
//    StatusEventsHandler::class,
//    PlaceableEventsHandler::class,
//    TaskEventsHandler::class,
]);
return $eventsManager;