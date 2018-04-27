<?php

namespace Handlers;

use Commands\PingCommand;

class PingHandler
{
	public function __invoke(PingCommand $command)
	{
		echo $command->passData() . PHP_EOL;
	}
}