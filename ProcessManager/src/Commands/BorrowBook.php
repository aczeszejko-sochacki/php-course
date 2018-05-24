<?php

namespace Commands;

class BorrowBook
{
	private $book_instance_id;
	private $account_id;
	private $date;
	private $date_to;

	public function __construct($book_instance_id,
		$account_id, $date, $date_to)
	{
		$this->book_instance_id = $book_instance_id;
		$this->account_id = $account_id;
		$this->date = $date;
		$this->date_to = $date_to;
	}

	public function getBook()
	{
		return $this->book_instance_id;
	}

	public function getAccount()
	{
		return $this->account_id;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getDateTo()
	{
		return $this->date_to;
	}
}


