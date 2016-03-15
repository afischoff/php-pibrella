<?php
// composer auto loader
$loader = require_once __DIR__ . '/vendor/autoload.php';
$loader->add('Afischoff', __DIR__ .'/src/');

// instantiate the Pibrella library
$pibrella = new \Afischoff\Pibrella();

// register an event handler for the button
$pibrella->button->onChange(function($value) use ($pibrella) {
	echo "Button State Change! {$value} \n";

	if ($value == 1) {
		$pibrella->outputF->on();
	} else {
		$pibrella->outputF->off();
	}
});

// register an event handler for input A
$pibrella->inputA->onChange(function($value) use ($pibrella) {
	if ($value == 1) {
		$pibrella->greenLed->on();
		echo "Input A value is now 1 \n";
	} else {
		$pibrella->lightsOff();
		echo "Input A value is now 0 \n";
	}
});

// start listening for events
$pibrella->listen();
