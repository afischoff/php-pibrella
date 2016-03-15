<?php
$loader = require_once __DIR__ . '/vendor/autoload.php';
$loader->add('Afischoff', __DIR__ .'/src/');

use Afischoff\Pibrella;

$pibrella = new Pibrella();
$pibrella->rotateLights();
