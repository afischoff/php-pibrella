<?php namespace Afischoff;

class Pin
{
	protected $gpio;
	protected $pinNumber;
	protected $direction;

	public function __construct($gpio, $pinNumber, $direction)
	{
		$this->gpio = $gpio;
		$this->pinNumber = $pinNumber;
		$this->direction = $direction;
		$gpio->setup($pinNumber, $direction);
	}

	public function unexport()
	{
		$this->gpio->unexport($this->pinNumber);
	}
}
