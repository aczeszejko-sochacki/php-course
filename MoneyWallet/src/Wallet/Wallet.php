<?php

namespace Wallet;
use Money\Money;
use Money\Currency;
use Events\DepositEvent;
use Events\WithdrawEvent;
use Events\ActivateEvent;
use Events\DeactivateEvent;
use Exception;

class Wallet
{
	private $balance;
	private $name;
	private $activated;

    public function __construct(string $name)
    {
    	$this->name = $name;
    	$this->balance = Money::PLN(0);
    }

    public function createHistory()
    {
    	if(!file_exists(__DIR__ . '/../../data/Wallets/' . $this->name . '.txt')){

    		file_put_contents(__DIR__ . '/../../data/Wallets/' . $this->name . '.txt', json_encode(array($this->name)));
    	}
    	else{

    		throw new Exception('This account exists!');
    	}
    }

    public static function fromEvents($events): Wallet
    {
    	$wallet_name = $events[0];

        $wallet_from_events = new Wallet(
        	$wallet_name);

        array_shift($events);

        foreach ($events as $event) {
        	
        	if(!is_object($event[1])){

        		call_user_func(array(
        		$wallet_from_events,
        		$event[0]), $event[1]);
        	}
        	else{

        		call_user_func(array(
        		$wallet_from_events,
        		$event[0]), new Money(
        			$event[1]->amount,
        			new Currency($event[1]->currency)));
        	}

        }

        
        return $wallet_from_events;
    }

    public function deposit(Money $moneyToDeposit)
    {
    	if($this->activated){

    		$this->balance = $this->balance->add(
        	$moneyToDeposit);
    	}
    }

    public function depositArchive(Money 
    	$moneyToDeposit)
    {
    	$event = new DepositEvent($this->name, 
        	$moneyToDeposit);
        $event->update();
    }

    public function withdraw(Money 
    	$moneyToWithdraw)
    {
    	if($this->activated){

    		$this->balance = $this->balance->subtract(
        	$moneyToWithdraw);
    	}
    }

    public function withdrawArchive(Money
    	$moneyToWithdraw)
    {
    	$event = new WithdrawEvent(
        		$this->name, $moneyToWithdraw);
        $event->update();
    }

    public function deactivate(string $reason)
    {
        $this->activated = false;
    }

    public function deactivateArchive(string 
    	$reason)
    {
    	$event = new DeactivateEvent(
    	 	$this->name, $reason);
        $event->update();
    }

    public function activate(string $reason)
    {
        $this->activated = true;
    }

    public function activateArchive(
    	string $reason)
    {
    	$event = new ActivateEvent($this->name, 
        	$reason);
        $event->update();
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }
}