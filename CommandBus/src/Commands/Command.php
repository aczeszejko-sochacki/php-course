<?php

namespace Commands;

abstract class Command
{
	private $created;

	abstract public function passData() : String;
}