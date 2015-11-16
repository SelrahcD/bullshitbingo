<?php

namespace BullshitBingo\Bingo\Domain\Model\Game;

class GameState
{
    const OPENED = 0;
    const STARTED = 1;

    private $state;

    /**
     * GameState constructor.
     */
    public function __construct()
    {
        $this->state = self::OPENED;
    }

    public function isOpened()
    {
        return $this->state === self::OPENED;
    }

    public function transitionToStarted()
    {
        $newState = new GameState();
        $newState->state = self::STARTED;
        return $newState;
    }

    public function isStarted()
    {
        return $this->state === self::STARTED;
    }
}
