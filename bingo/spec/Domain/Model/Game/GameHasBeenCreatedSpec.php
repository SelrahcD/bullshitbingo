<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Game;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameHasBeenCreatedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Model\Game\GameHasBeenCreated');
    }
}
