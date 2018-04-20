<?php

namespace Events;

class DeactivateEvent implements IEvent
{
	private $wallet_name;
	private $reason;

	public function __construct(
		string $wallet_name, string $reason)
	{
		$this->wallet_name = $wallet_name;
		$this->reason = $reason;
	}

	public function update()
	{
		$events = json_decode(file_get_contents(__DIR__ . '/../../data/Wallets/' . 
			$this->wallet_name . 
			'.txt'));

        array_push($events, 
        	array('deactivate', 
        		$this->reason));

        file_put_contents(__DIR__ . '/../../data/Wallets/' . $this->wallet_name . 
        	'.txt', json_encode($events));
	}
}