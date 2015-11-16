<?php

namespace BullshitBingo\Bingo\Domain;

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

    private function __construct(GameId $gameId)
    {
        $this->id = $gameId;
        $this->storeEvent(new GameHasBeenCreated());
    }

    /**
     * @param GameId $gameId
     * @param Theme $theme
     * @return Game
     */
    public static function createUsingTheme(GameId $gameId, Theme $theme)
    {
        return new Game($gameId);
    }

    public function releaseEvents()
    {
        return $this->events;
    }

    public function isOpened()
    {
        return true;
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
}
