<?php

require_once 'Frame.php';
require_once 'FinalFrame.php';
require_once 'BowlingBall.php';
require_once 'Scores.php';

$scores = new Scores($argv[1]);

echo $scores->getSum();
