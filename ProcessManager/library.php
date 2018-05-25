<?php

require 'vendor/autoload.php';

use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\EventRouter;
use Database\DBConnection;
use Commands\BorrowBook;
use Commands\ReturnBook;
use Commands\SettleBook;
use Commands\CalculatePenalty;
use Commands\RegisterPayment;
use Handlers\BorrowBookHandler;
use Handlers\ReturnBookHandler;
use Handlers\SettleBookHandler;
use Handlers\CalculatePenaltyHandler;
use Handlers\RegisterPaymentHandler;

/**
* Example of using EventBus
* This is a simulation of simple library
*/

$event_bus = new EventBus();

$event_router = new EventRouter();

$event_router->route(Commands\BorrowBook::class)
	->to(new Handlers\BorrowBookHandler());

$event_router->route(Commands\ReturnBook::class)
	->to(new Handlers\ReturnBookHandler($event_bus));

$event_router->route(Commands\SettleBook::class)
	->to(new Handlers\SettleBookHandler());

$event_router->route(Commands\CalculatePenalty::class)
	->to(new Handlers\CalculatePenaltyHandler());

$event_router->route(Commands\RegisterPayment::class)
	->to(new Handlers\RegisterPaymentHandler($event_bus));

$event_router->attachToMessageBus($event_bus);

$borrow1 = new BorrowBook(1, 2, '03/05/18', '03/06/18');
$borrow2 = new BorrowBook(2, 2, '03/06/18', '03/07/18');
$return1 = new ReturnBook(1, 2, '10/06/18');
$penalty2 = new CalculatePenalty(2, 2, 100, '04/07/18');
$pay2 = new RegisterPayment(2, 2, 90, '05/07/18');
$pay2v2 = new RegisterPayment(2, 2, 10, '06/07/18');
$return2 = new ReturnBook(2, 2, '06/07/18');

$event_bus->dispatch($borrow1);
$event_bus->dispatch($borrow2);
$event_bus->dispatch($return1);
$event_bus->dispatch($penalty2);
$event_bus->dispatch($pay2);
$event_bus->dispatch($pay2v2);
$event_bus->dispatch($return2);
