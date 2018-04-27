<?php

namespace Handlers;

use Commands\PongCommand;

class PongHandler
{
	public function __invoke(PongCommand $command)
	{
		echo $command->passData() . PHP_EOL;
	}
}