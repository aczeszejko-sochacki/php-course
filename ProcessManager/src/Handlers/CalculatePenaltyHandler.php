<?php

namespace Handlers;

use Database\DBConnection;
use Commands\CalculatePenalty;

class CalculatePenaltyHandler
{
	public function __invoke(CalculatePenalty $event)
	{
		$db_conn_instance = new DBConnection();
		$db_conn = $db_conn_instance->getConnection();
		
		pg_query('UPDATE book SET
		penalty = '
		. $event->getAmount()
		. 'WHERE book_instance_id = '
		. $event->getBook() . ';');
	
		pg_close($db_conn);
	}
}
