# Overview
A project that provides the total score for a ten bowling game when given a sequence of valid inputs for any amount of 
frames played.

> **Note**: This assumes that there is a valid input provided, so no validations are being made.

# Ten-Pin Bowling
More information on ten-pin bowling can be found [here](https://www.topendsports.com/sport/tenpin/scoring.htm).

For quick reference:
* There can be up to 10 frames.
* Valid input formats for each frame can be:
  * `5-` : this indicates 5 pins knocked down in the first throw, and none in the second
  * `52` : this indicates 5 pins knocked down in the first throw and 2 in the second
  * `5/` : this indicates a spare ie 5 pins in the first throw, and the other 5 in the second
  * `x` : a strike - all pins down in the first throw.
* When a strike is scored, the frame also gets the scores from the next two throws
* When a spare is scored, the frame also gets the score added from the next throw
* This means that we cannot score either of these frames until further throws are made.

Assuming the input is a string containing a comma separated list:

```text
81,72,x,x,9/,9-
```

This would be 6 completed frames and the score would be 95. The score can validated at https://www.bowlinggenius.com/

# Usage
The script can be run using a composer command:
```shell
composer calculate "81,72,x,x,9/,9-"
```
Please do take note that I was only able to test this out by running the command manually using different inputs. In a real-world scenario, I'd lay out a couple of unit tests to ensure the integrity of the calculations.
