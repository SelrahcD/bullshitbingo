<?php

namespace spec\BullshitBingo\Bingo\Domain;

use BullshitBingo\Bingo\Domain\GameHasBeenCreated;
use BullshitBingo\Bingo\Domain\GameId;
use BullshitBingo\Bingo\Domain\Player;
use BullshitBingo\Bingo\Domain\PlayerJoinedTheGame;
use BullshitBingo\Bingo\Domain\Theme;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
    private $gameId;

    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Game');
    }

    function let(Theme $theme)
    {
        $this->gameId = GameId::generate();
        $this->beConstructedThrough('createUsingTheme', [$this->gameId, $theme]);
    }
    
    function it_should_release_GameHasBeenCreated_event_when_created()
    {
        $this->releaseEvents()->shouldContainSomethingLike(new GameHasBeenCreated);
    }
    
    function it_should_be_opened_when_created()
    {
        $this->isOpened()->shouldReturn(true);
    }

    function it_should_accept_new_player(Player $player)
    {
        $this->accept($player);
    }
    
    function it_should_release_PlayerJoinedTheGame_event_when_a_player_is_accepted(Player $player)
    {
        $this->accept($player);
        $this->releaseEvents()->shouldContainSomethingLike(new PlayerJoinedTheGame($this->gameId));
    }
    
    function it_should_not_have_accepted_any_player_when_created()
    {
        $this->playerCount()->shouldReturn(0);
    }

    function it_should_count_how_many_players_joined_the_game(Player $player1, Player $player2)
    {
        $this->accept($player1);
        $this->playerCount()->shouldReturn(1);
        $this->accept($player2);
        $this->playerCount()->shouldReturn(2);
    }
    
    function it_should_not_count_same_player_twice(Player $player)
    {
        $this->accept($player);
        $this->playerCount()->shouldReturn(1);
        $this->accept($player);
        $this->playerCount()->shouldReturn(1);
    }

    function it_should_not_publish_PlayerJoinedTheGame_event_twice_for_the_same_player(Player $player)
    {
        $this->accept($player);
        $this->releaseEvents()->shouldContainSomethingLike(new PlayerJoinedTheGame($this->gameId));
        $this->accept($player);
        $this->releaseEvents()->shouldNotContainSomethingLike([new PlayerJoinedTheGame($this->gameId), new PlayerJoinedTheGame($this->gameId)]);
    }

    public function it_should_clear_events()
    {
        $this->clearEvents();
        $this->releaseEvents()->shouldReturn([]);
    }

    public function getMatchers()
    {
        return [
            'containSomethingLike' => function($subject, $value) {
                if(!is_array($value)) {
                    return in_array($value, $subject);
                }

                $count = count($value);
                $found = 0;
                foreach ($value as $item) {
                    if(($rank = array_search($item, $subject)) !== false) {
                        $found++;
                        unset($subject[$rank]);
                    }
                }

                return $found === $count;
            }
        ];
    }

}
