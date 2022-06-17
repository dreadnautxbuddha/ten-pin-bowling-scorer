<?php

/**
 * Represents a series of scores that make up a bowling game match.
 *
 * @author Peter Cortez <innov.petercortez@gmail.com>
 */
class Scores
{
    /**
     * @var array
     */
    protected array $frames;

    /**
     * @param string $scores
     */
    public function __construct(string $scores)
    {
        $scores = explode(',', $scores);
        foreach ($scores as $index => $_scores) {
            $frame = new Frame($index + 1 === count($scores));

            foreach (str_split($_scores) as $score) {
                $ball = new BowlingBall;

                $frame->throw($ball);

                $ball->setScore($score);
            }

            $this->frames[] = $frame;
        }
    }

    /**
     * Returns the sum of all the scores.
     *
     * @return int
     */
    public function getSum(): int
    {
        $total = 0;

        /** @var \Frame $frame */
        foreach ($this->frames as $index => $frame) {
            $nextFrame = $this->frames[$index + 1] ?? new Frame;
            $nextNextFrame = $this->frames[$index + 2] ?? new Frame;
            $total += $frame->getScore();

            if ($frame->isStrike()) {
                // Since the current frame is a strike, we're going to take the
                // next two (2) balls and add it to our current frame's score.
                if ($nextFrame->isStrike()) {
                    // However, we need to consider that the next frame may be
                    // another strike. That means the first ball on the next frame
                    // after the next one should be taken into account.
                    $total += $nextFrame->getScore();
                    $total += $nextNextFrame->getFirstThrowScore();
                } else {
                    // Otherwise, if the next frame isn't a strike, we'll just get
                    // the next frame's score since it accounts for the next two (2)
                    // balls that was thrown
                    $total += $nextFrame->getScore();
                }
            } else if ($frame->isSpare()) {
                // For spares, we only care about the next ball that is thrown.
                $total += $nextFrame->getFirstThrowScore();
            }
        }

        return $total;
    }
}
