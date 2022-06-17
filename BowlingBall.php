<?php

/**
 * Represents a bowling ball that is thrown in a frame, and gains scores.
 *
 * @author Peter Cortez <innov.petercortez@gmail.com>
 */
class BowlingBall
{
    /**
     * @var string
     */
    protected string $score;

    /**
     * @return string
     */
    public function getScore(): string
    {
        return $this->score;
    }

    /**
     * @param string $score
     *
     * @return void
     */
    public function setScore(string $score): void
    {
        $this->score = $score;
    }
}
