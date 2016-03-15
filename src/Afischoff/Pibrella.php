<?php namespace Afischoff;

use PhpGpio\Gpio;

class Pibrella
{
	const LED_GREEN_PIN = 4;
	const LED_YELLOW_PIN = 17;
	const LED_RED_PIN = 27;

	const INPUT_A_PIN = 9;
	const INPUT_B_PIN = 7;
	const INPUT_C_PIN = 8;
	const INPUT_D_PIN = 10;
	const INPUT_BUTTON_PIN = 11;

	const OUTPUT_E_PIN = 22;
	const OUTPUT_F_PIN = 23;
	const OUTPUT_G_PIN = 24;
	const OUTPUT_H_PIN = 25;
	const OUTPUT_BUZZER_PIN = 18;

	const DIRECTION_OUT = "out";
	const DIRECTION_IN = "in";

	const PI_GPIO_PATH = "/sys/class/gpio/";

	protected $gpio;

	public $redLed;
	public $yellowLed;
	public $greenLed;

	public $button;
	public $inputA;
	public $inputB;
	public $inputC;
	public $inputD;
	public $inputs;

	public function __construct()
	{
		$this->gpio = new Gpio();

		$this->button = new Input($this->gpio, self::INPUT_BUTTON_PIN, self::DIRECTION_IN);
		$this->inputA = new Input($this->gpio, self::INPUT_A_PIN, self::DIRECTION_IN);
		$this->inputB = new Input($this->gpio, self::INPUT_B_PIN, self::DIRECTION_IN);
		$this->inputC = new Input($this->gpio, self::INPUT_C_PIN, self::DIRECTION_IN);
		$this->inputD = new Input($this->gpio, self::INPUT_D_PIN, self::DIRECTION_IN);
		$this->inputs = [$this->button, $this->inputA, $this->inputB, $this->inputC, $this->inputD];

		$this->redLed = new Output($this->gpio, self::LED_RED_PIN, self::DIRECTION_OUT);
		$this->yellowLed = new Output($this->gpio, self::LED_YELLOW_PIN, self::DIRECTION_OUT);
		$this->greenLed = new Output($this->gpio, self::LED_GREEN_PIN, self::DIRECTION_OUT);
		$this->buzzer = new Output($this->gpio, self::OUTPUT_BUZZER_PIN, self::DIRECTION_OUT);
		$this->outputE = new Output($this->gpio, self::OUTPUT_E_PIN, self::DIRECTION_OUT);
		$this->outputF = new Output($this->gpio, self::OUTPUT_F_PIN, self::DIRECTION_OUT);
		$this->outputG = new Output($this->gpio, self::OUTPUT_G_PIN, self::DIRECTION_OUT);
		$this->outputH = new Output($this->gpio, self::OUTPUT_H_PIN, self::DIRECTION_OUT);
	}

	public function __destruct()
	{
		$this->gpio->unexportAll();
	}

	public function listen()
	{
		echo "Listening for events... \n\n";
		while (true) {
			usleep(100000);
			foreach ($this->inputs as $input) {
				if (!empty($input->getCallback()) && $input->getState() != $input->getCurrentValue()) {
					call_user_func($input->getCallback(), $input->getCurrentValue());
					$input->setState($input->getCurrentValue());
				}
			}
		}
	}

	public function lightsOff()
	{
		$this->redLed->off();
		$this->yellowLed->off();
		$this->greenLed->off();
	}

	public function rotateLights()
	{
		for ($i = 1; $i <= 5; $i++) {
			$this->redLed->on();
			usleep(100000);
			$this->redLed->off();

			$this->yellowLed->on();
			usleep(100000);
			$this->yellowLed->off();

			$this->greenLed->on();
			usleep(100000);
			$this->greenLed->off();
		}
	}
}
