<?php

/**
 * Represents a frame in a bowling game
 *
 * @author Peter Cortez <innov.petercortez@gmail.com>
 */
class Frame
{
    /**
     * Indicates the number of pins of a given frame.
     *
     * @const int
     */
    const PIN_QTY = 10;

    /**
     * @var \BowlingBall[]
     */
    protected array $thrownBalls = [];

    /**
     * Throws a bowling ball.
     *
     * @param \BowlingBall $ball
     *
     * @return void
     */
    public function throw(BowlingBall $ball)
    {
        $this->thrownBalls[] = $ball;
    }

    /**
     * Returns the first score gained by the first ball that was thrown during the
     * frame's lifetime.
     *
     * @return int
     */
    public function getFirstThrowScore(): int
    {
        if ($this->isStrike()) {
            return self::PIN_QTY;
        }

        if (! empty($this->thrownBalls)) {
            return $this->thrownBalls[0]->getScore();
        }

        return 0;
    }

    /**
     * Returns the score gained during this frame only -- not taking into
     * consideration other frames.
     *
     * @return int
     */
    public function getScore(): int
    {
        if ($this->isStrike() || $this->isSpare()) {
            return self::PIN_QTY;
        }

        return array_sum(
            array_map(
                function ($bowlingBall) {
                    return $bowlingBall->getScore();
                },
                $this->thrownBalls
            )
        );
    }

    /**
     * Determines whether the score we have obtained when the ball was thrown was a
     * strike.
     *
     * @return bool
     */
    public function isStrike(): bool
    {
        return ! empty($this->thrownBalls)
            && $this->thrownBalls[0]->isStrikeSymbol();
    }

    /**
     * Determines whether the score we have obtained when the ball was thrown was a
     * spare.
     *
     * @return bool
     */
    public function isSpare(): bool
    {
        return ! empty($this->thrownBalls)
            && ! $this->isStrike()
            && $this->thrownBalls[1]->isSpareSymbol();
    }
}
