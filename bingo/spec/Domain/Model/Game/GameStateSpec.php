<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Game;

use BullshitBingo\Bingo\Domain\Model\Game\GameState;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameStateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Model\Game\GameState');
    }

    function it_should_be_opened_when_created()
    {
        $this->isOpened()->shouldReturn(true);
    }

    function it_can_transition_from_open_to_started()
    {
        $this->transitionToStarted()->shouldBeAnInstanceOf(GameState::class);
        $this->transitionToStarted()->isStarted()->shouldReturn(true);
        $this->transitionToStarted()->isOpened()->shouldReturn(false);
    }
}
