<?php

require 'vendor/autoload.php';

use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\EventRouter;
use Database\DBConnection;
use Commands\BorrowBook;
use Handlers\BorrowBookHandler;

$event_bus = new EventBus();

$event_router = new EventRouter();

$event_router->route(Commands\BorrowBook::class)
	->to(new Handlers\BorrowBookHandler());

$event_router->attachToMessageBus($event_bus);

$event = new BorrowBook(1, 2, '03/05/18', '03/06/18');

$event_bus->dispatch($event);
