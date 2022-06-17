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
    protected string $score = '0';

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

    /**
     * Determines whether the score we have obtained when the ball was thrown was a
     * strike.
     *
     * @return bool
     */
    public function isStrikeSymbol(): bool
    {
        return strtolower($this->getScore()) === 'x';
    }

    /**
     * Determines whether the score we have obtained looks like a forward slash. This
     * denotes a spare.
     *
     * @return bool
     */
    public function isSpareSymbol(): bool
    {
        return $this->getScore() === '/';
    }
}
