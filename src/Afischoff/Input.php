<?php namespace Afischoff;

class Input extends Pin
{
	protected $callback;
	protected $state;

	public function __construct($gpio, $pinNumber, $direction)
	{
		parent::__construct($gpio, $pinNumber, $direction);
		$this->state = 0;
	}

	public function onChange($callback)
	{
		$this->callback = $callback;
	}

	public function getCallback()
	{
		return $this->callback;
	}

	public function setState($state)
	{
		$this->state = $state;
	}

	public function getState()
	{
		return $this->state;
	}

	public function getCurrentValue()
	{
		return $this->gpio->input($this->pinNumber);
	}
}
