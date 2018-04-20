<?php

namespace Events;
use Money\Money;
use Money\Currency;

class WithdrawEvent implements IEvent
{
	private $moneyToWithdraw;
	private $wallet_name;

	public function __construct(
		string $wallet_name, 
		Money $moneyToWithdraw)
	{
		$this->moneyToWithdraw = $moneyToWithdraw;
		$this->wallet_name = $wallet_name;
	}

	public function update()
	{
		$events = json_decode(file_get_contents(__DIR__ . '/../../data/Wallets/' . 
			$this->wallet_name . 
			'.txt'));

        array_push($events, 
        	array('withdraw', 
        		$this->moneyToWithdraw));

        file_put_contents(__DIR__ . '/../../data/Wallets/' . $this->wallet_name . 
        	'.txt', json_encode($events));
	}
}