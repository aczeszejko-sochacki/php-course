<?php

namespace Commands;

class ReturnBook
{
	private $book_instance_id;
	private $account_id;
	private $date;

	public function __construct($book_instance_id,
		$account_id, $date)
	{
		$this->book_instance_id = $book_instance_id;
		$this->account_id = $account_id;
		$this->date = $date;
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
}
