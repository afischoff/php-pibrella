<?php namespace Afischoff;

class Output extends Pin
{
	public function on()
	{
		$this->setValue(1);
	}

	public function off()
	{
		$this->setValue(0);
	}

	public function setValue($value) {
		$this->gpio->output($this->pinNumber, $value);
	}
}