<?php

/**
 * Represents a frame in a bowling game
 *
 * @author Peter Cortez <innov.petercortez@gmail.com>
 */
class FinalFrame extends Frame
{
    /**
     * @inheritDoc
     */
    public function getScore(): int
    {
        if ($this->isSpare()) {
            // If we got a spare, that means that the first two (2) throws took down
            // all the pins -- so we just have to add the final throw score to it.
            return self::PIN_QTY + ($this->thrownBalls[2] ?? new BowlingBall)->getScore();
        } else if ($this->isStrike()) {
            // For strikes, however, it means that we will have two (2) more shots
            // that can be a strike, spare, or just a numeric score. That's why here,
            // we are only going to look at the second and last shot (since the first
            // score is already known)
            $total = self::PIN_QTY;
            $second = ($this->thrownBalls[1] ?? new BowlingBall);
            $third = ($this->thrownBalls[2] ?? new BowlingBall);

            $total += $second->isStrikeSymbol() ? self::PIN_QTY : $second->getScore();
            $total += $third->isStrikeSymbol() || $third->isSpareSymbol()
                ? self::PIN_QTY
                : $third->getScore();

            return $total;
        }

        return parent::getScore();
    }

    /**
     * Returns the same instance of this Final Frame, but without the third ball to
     * be considered in calculating its score. Mainly used in calculating the strike
     * score of a frame that's before the final one.
     *
     * @return \FinalFrame
     */
    public function withoutThirdBall(): FinalFrame
    {
        if (count($this->thrownBalls) < 3) {
            return $this;
        }

        $frame = new static;

        foreach ($this->thrownBalls as $index => $ball) {
            if (count($this->thrownBalls) === $index + 1) {
                continue;
            }
            $frame->throw($ball);
        }

        return $frame;
    }
}
