<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Player;

use BullshitBingo\Bingo\Domain\Model\Game\Game;
use BullshitBingo\Bingo\Domain\Model\Game\GameId;
use BullshitBingo\Bingo\Domain\Model\Theme\Theme;
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
    
    function it_can_create_a_game_using_a_theme(Theme $theme)
    {
        $this->createAGameUsingTheme(GameId::generate(), $theme)->shouldBeAnInstanceOf(Game::class);
    }

    function it_should_start_a_game(Game $game)
    {
        $this->startGame($game);
        $game->startByUser($this)->shouldHaveBeenCalled();
    }
}
