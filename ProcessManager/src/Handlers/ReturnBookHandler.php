<?php

namespace Handlers;

use Database\DBConnection;
use Commands\ReturnBook;
use Commands\SettleBook;
use Prooph\ServiceBus\EventBus;

class ReturnBookHandler
{
	private $event_bus;

	public function __construct(EventBus $event_bus)
	{
		$this->event_bus = $event_bus;
	}

	public function __invoke(ReturnBook $event)
	{
		$db_conn_instance = new DBConnection();
		$db_conn = $db_conn_instance->getConnection();

		$paid = pg_query('SELECT penalty
		FROM book WHERE book_instance_id = '
		. $event->getBook());

		// if there is no penalty
		if (pg_fetch_result($paid, 0, 0) == 0) {
			
			pg_query('UPDATE book SET
			(account_id, date, date_to)
			= (NULL, NULL, NULL)
			WHERE book_instance_id = '
			. $event->getBook());

		$this->event_bus->dispatch(new SettleBook(
		 'PROCESS COMPLETED'));
		}
		
		pg_close($db_conn);
	}
}
