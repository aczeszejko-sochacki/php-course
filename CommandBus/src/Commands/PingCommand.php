<?php

namespace Commands;

class PingCommand extends Command
{
	public function __construct()
	{
		$this->created = date("Y-m-d H:i:s");
	}

	public function passData() : String
	{
		return 'PING';
	}
}