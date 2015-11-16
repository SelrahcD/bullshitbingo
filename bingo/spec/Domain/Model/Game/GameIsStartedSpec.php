<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Game;

use BullshitBingo\Bingo\Domain\Model\Game\GameId;
use BullshitBingo\Bingo\Domain\Model\Game\GameIsStarted;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameIsStartedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Model\Game\GameIsStarted');
    }

    function let()
    {
        $this->beConstructedWith(GameId::generate());
    }
    
    function it_should_be_different_than_an_event_for_an_other_game()
    {
        $this->shouldNotBeLike(new GameIsStarted(GameId::generate()));
    }
    
    function it_should_be_equal_to_an_event_for_same_game()
    {
        $gameId = GameId::generate();
        $this->beConstructedWith($gameId);
        $this->shouldBeLike(new GameIsStarted($gameId));
    }
}
