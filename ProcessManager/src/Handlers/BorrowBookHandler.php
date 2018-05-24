<?php

namespace Handlers;

use Database\DBConnection;

class BorrowBookHandler
{
	public function __invoke($event)
	{
		$db_conn_instance = new DBConnection();
		$db_conn = $db_conn_instance->getConnection();

		pg_query('UPDATE book SET
		(account_id, date, date_to, borrowed) = (\''
		. $event->getAccount() . '\', \''
		. $event->getDate() . '\', \''
		. $event->getDateTo()
		. '\', DEFAULT)
		WHERE book_instance_id = ' . $event->getBook()
		. ';');
		
		pg_close($db_conn);
	}
}
