<?php

namespace spec\BullshitBingo\Bingo\Domain;

use BullshitBingo\Bingo\Domain\Game;
use BullshitBingo\Bingo\Domain\GameId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\GameId');
    }

    function let()
    {
        $this->beConstructedThrough('generate');
    }
    
    function it_should_say_if_gameId_are_equal()
    {
        $this->equals($this)->shouldReturn(true);
    }

    function it_should_say_if_gameId_are_not_equal()
    {
        $this->equals(GameId::generate())->shouldReturn(false);
    }
}
