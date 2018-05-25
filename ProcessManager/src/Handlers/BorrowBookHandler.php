<?php

namespace Handlers;

use Database\DBConnection;
use Commands\BorrowBook;

class BorrowBookHandler
{
	public function __invoke(BorrowBook $event)
	{
		$db_conn_instance = new DBConnection();
		$db_conn = $db_conn_instance->getConnection();

		pg_query('UPDATE book SET
		(account_id, date, date_to) = (\''
		. $event->getAccount() . '\', \''
		. $event->getDate() . '\', \''
		. $event->getDateTo() . '\')
		WHERE book_instance_id = ' 
		. $event->getBook()
		. ';');
		
		pg_close($db_conn);
	}
}
