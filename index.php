<?php

require_once 'Frame.php';
require_once 'FinalFrame.php';
require_once 'BowlingBall.php';
require_once 'Scores.php';

$scores = new Scores('81,72,x,x,9/,9-');

echo $scores->getSum();
