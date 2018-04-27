<?php

namespace CommandBus;

use Router\DirectRouter;
use Commands\Command;

class CommandBus
{
	public function dispatch(Command $command)
	{
		$router = new DirectRouter([
    		'Commands\PingCommand' => 
    		 'Handlers\PingHandler',
    		'Commands\PongCommand' => 
    		 'Handlers\PongHandler'
		]);

		$handler_name = 
		 $router->transfer($command);

		$handler_object = new $handler_name();
		$handler_object($command);
	}
}