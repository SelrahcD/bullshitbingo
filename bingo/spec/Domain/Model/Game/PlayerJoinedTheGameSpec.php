<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Game;

use BullshitBingo\Bingo\Domain\Model\Game\GameId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlayerJoinedTheGameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Model\Game\PlayerJoinedTheGame');
    }

    function let(GameId $gameId)
    {
        $this->beConstructedWith($gameId);
    }
}
