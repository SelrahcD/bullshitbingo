<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Player;

use BullshitBingo\Bingo\Domain\Model\Game\Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlayerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Model\Player\Player');
    }

    function it_should_be_able_to_join_a_game(Game $game)
    {
        $this->join($game);
        $game->accept($this)->shouldHaveBeenCalled();
    }
}
