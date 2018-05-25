<?php

namespace Handlers;
use Commands\SettleBook;

class SettleBookHandler
{
	public function __invoke(SettleBook $event)
	{
		echo $event->getMessage() . PHP_EOL;
	}
}
