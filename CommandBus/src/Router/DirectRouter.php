<?php

namespace Router;

use Commands\Command;
use Handlers\PingHandler;
use Handlers\PongHandler;
use Exception;

class DirectRouter implements Router
{
	private $handlers;

	public function __construct(Array $handlers)
	{
		$this->handlers = $handlers;
	}

	public function transfer(Command $command)
	{
		if(array_key_exists(get_class($command), 
			$this->handlers)){

			return $this->handlers[get_class(
			$command)];
		}
		else{

			throw new Exception('No handler for this key');
		}
	}
}