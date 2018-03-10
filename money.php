<?php
class Money{

    protected $currency;
    protected $value;

	public function __construct($currency, $value){
        $this->currency = $currency;
        $this->value = $value;
	}

	protected function compare_currencies( Money $money){
		if($this->currency != $money->currency){
			throw new Exception('Wrong currency!' . PHP_EOL);
		}
	}

	public function add_value(Money $money){
		try {$this->compare_currencies($money);}
		catch (Exception $wrong_currency){
            echo $wrong_currency->getMessage();
			return 0;
		}
        
        $this->value += $money->value;
	}

	public function substract_value(Money $money){
        try {$this->compare_currencies($money);}
		catch (Exception $wrong_currency){
            echo $wrong_currency->getMessage();
            return 0;
		}
        
        $this->value -= $money->value;
	}

	public function multiply_by_value($value){
        $this->value *= $value;
	}

	protected function check_division($value){
		if($value == 0) throw new Exception(
			'Division by zero!' . PHP_EOL);
	}

	public function divide_by_value($value){
        try {$this->value /= $value;}
        catch (Exception $division_by_zero){
        	echo $division_by_zero->getMessage();
        }
	}

	public function print_money(){
		return $this->currency . ' ' . $this->value . PHP_EOL;
	}
}

interface MoneyFormatter{

    public function money_to_string();
}

class Formatter extends Money implements MoneyFormatter{
    
    public function money_to_string(){
    	return (string)$this->value . ' ' . 
    	       (string)$this->currency;
    }

    public function to_thousands_and_comma(){
        $value_and_currency = explode(" ",
                                   $this->money_to_string());

        $value = explode('.', $value_and_currency[0]);
        
        return substr(strrev(chunk_split(
        	strrev($value[0]), 3, ' ')), 1) . ',' . 
        $value[1] . ' ' . $value_and_currency[1];
    }
}

$money = new Money('PLN', 100);
$money->divide_by_value(2);


$formatter = new Formatter($argv[1], $argv[2]);

for($i = 2; $i < $argc; $i++){
	$formatter->add_value(new Money($argv[1], $argv[$i]));
}

echo $formatter->to_thousands_and_comma();
