<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Game;

use BullshitBingo\Bingo\Domain\Model\Game\GameHasBeenCreated;
use BullshitBingo\Bingo\Domain\Model\Game\GameId;
use BullshitBingo\Bingo\Domain\Model\Game\GameIsStarted;
use BullshitBingo\Bingo\Domain\Model\Game\PlayerJoinedTheGame;
use BullshitBingo\Bingo\Domain\Model\Player\Player;
use BullshitBingo\Bingo\Domain\Model\Theme\Theme;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
    private $gameId;

    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Model\Game\Game');
    }

    function let(Theme $theme, Player $creator)
    {
        $this->gameId = GameId::generate();
        $this->beConstructedThrough('createUsingTheme', [$this->gameId, $creator, $theme]);
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

    function it_can_be_started_by_the_player_who_created_it(Player $creator)
    {
        $this->startByUser($creator);
        $this->isStarted()->shouldReturn(true);
    }
    
    function it_should_not_be_started_by_an_other_player_than_the_creator(Player $someOtherPlayer)
    {
        $this->startByUser($someOtherPlayer);
        $this->isStarted()->shouldReturn(false);
    }
    
    function it_should_publish_a_GameIsStarted_event_when_started_by_the_creator(Player $creator)
    {
        $this->startByUser($creator);
        $this->releaseEvents()->shouldContainSomethingLike(new GameIsStarted($this->gameId));
    }

    function it_should_not_publish_a_GameIsStarted_event_when_someone_else_than_the_creator_try_to_start_the_game(Player $someOtherPlayer)
    {
        $this->startByUser($someOtherPlayer);
        $this->releaseEvents()->shouldNotContainSomethingLike(new GameIsStarted($this->gameId));
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
