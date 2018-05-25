<?php

namespace Handlers;

use Database\DBConnection;
use Commands\RegisterPayment;
use Commands\SettleBook;
use Prooph\ServiceBus\EventBus;

class RegisterPaymentHandler
{
	private $event_bus;

	public function __construct(EventBus $event_bus)
	{
		$this->event_bus = $event_bus;
	}

	public function __invoke(RegisterPayment $event)
	{
		$db_conn_instance = new DBConnection();
		$db_conn = $db_conn_instance->getConnection();
	

		// register payment in db	
		pg_query('UPDATE book SET
		penalty = penalty - '
		. $event->getAmount()
		. ' WHERE book_instance_id = '
		. $event->getBook()
		. ';');

		$book = pg_query('SELECT date, date_to,
		penalty
		FROM book WHERE book_instance_id = '
		. $event->getBook());

		// check if paid ad returned
		if (pg_fetch_result($book, 0, 0) == 'NULL'
			&& pg_fetch_result($book, 0, 1) == 'NULL'
			&& pg_fetch_result($book, 0, 2)) {

			$this->event_bus->dispatch(new SettleBook(
			 'PROCESS COMPLETED'));			
		}

		pg_close($db_conn);
	}
}
