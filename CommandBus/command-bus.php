<?php

require 'vendor/autoload.php';

use Commands\Command;
use Commands\PingCommand;
use Commands\PongCommand;
use CommandBus\CommandBus;

$command_bus = new CommandBus();
$command_bus->dispatch(new PingCommand());
$command_bus->dispatch(new PongCommand());
