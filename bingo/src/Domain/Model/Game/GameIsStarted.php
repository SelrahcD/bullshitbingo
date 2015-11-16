<?php

namespace BullshitBingo\Bingo\Domain\Model\Game;

class GameIsStarted
{
    /**
     * @var GameId
     */
    private $gameId;

    public function __construct(GameId $gameId)
    {
        $this->gameId = $gameId;
    }
}
