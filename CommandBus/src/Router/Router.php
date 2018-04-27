<?php 

namespace Router;

use Commands\Command;

interface Router
{
	public function transfer(Command $command);
}