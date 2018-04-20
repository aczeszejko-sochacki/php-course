<?php

namespace Events;
use Money\Money;
use Money\Currency;

class DepositEvent implements IEvent
{
	private $moneyToDeposit;
	private $wallet_name;

	public function __construct(
		string $wallet_name, Money $moneyToDeposit)
	{
		$this->moneyToDeposit = $moneyToDeposit;
		$this->wallet_name = $wallet_name;
	}

	public function update()
	{
		$events = json_decode(file_get_contents(__DIR__ . '/../../data/Wallets/' . 
			$this->wallet_name . 
			'.txt'));

        array_push($events, 
        	array('deposit', 
        		$this->moneyToDeposit));

        file_put_contents(__DIR__ . '/../../data/Wallets/' . $this->wallet_name . 
        	'.txt', json_encode($events));
	}
}