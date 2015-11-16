<?php

namespace spec\BullshitBingo\Bingo\Domain;

use BullshitBingo\Bingo\Domain\GameId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlayerJoinedTheGameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\PlayerJoinedTheGame');
    }

    function let(GameId $gameId)
    {
        $this->beConstructedWith($gameId);
    }
}
