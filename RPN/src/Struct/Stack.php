<?php

namespace Struct;
use Exception;

class Stack implements Structure
{
	private $structure;

	public function __construct()
	{
    	$this->structure = array();
    }

	public function push($element)
	{
		array_push($this->structure, $element);
	}

	public function pop()
	{
		if(empty($this->structure)){

			throw new Exception('Pop from empty stack');
		}

		return array_pop($this->structure);
	}

	public function clear()
	{
		$this->structure = array();
	}
}