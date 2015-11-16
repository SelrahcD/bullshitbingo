<?php
namespace BullshitBingo\Bingo\Domain\Model\Game;

use BullshitBingo\Bingo\Domain\Model\Player\Player;
use BullshitBingo\Bingo\Domain\Model\Theme\Theme;

/**
 * Class Game
 * @package BullshitBingo\Bingo\Domain
 */
class Game
{
    /**
     * @var GameId
     */
    private $id;

    /**
     * @var array
     */
    private $events = [];
    /**
     * @var array
     */
    private $players = [];

    /**
     * @var GameState
     */
    private $state;

    /**
     * @var Player
     */
    private $creator;

    private function __construct(GameId $gameId, Player $creator)
    {
        $this->id = $gameId;
        $this->creator = $creator;
        $this->state = new GameState();
        $this->storeEvent(new GameHasBeenCreated());
    }

    /**
     * @param GameId $gameId
     * @param Player $creator
     * @param Theme $theme
     * @return Game
     */
    public static function createUsingTheme(GameId $gameId, Player $creator, Theme $theme)
    {
        return new Game($gameId, $creator);
    }

    public function releaseEvents()
    {
        return $this->events;
    }

    public function isOpened()
    {
        return $this->state->isOpened();
    }

    public function accept(Player $player)
    {
        if(array_search($player, $this->players) === false) {
            $this->players[] = $player;
            $this->storeEvent(new PlayerJoinedTheGame($this->id));
        }
    }

    private function storeEvent($event)
    {
        $this->events[] = $event;
    }

    public function clearEvents()
    {
        $this->events = [];
    }

    public function playerCount()
    {
        return count($this->players);
    }

    public function startByUser(Player $player)
    {
        if($player === $this->creator) {
            $this->state = $this->state->transitionToStarted();
            $this->storeEvent(new GameIsStarted($this->id));
        }
    }

    public function isStarted()
    {
        return $this->state->isStarted();
    }
}
