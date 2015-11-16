<?php

namespace BullshitBingo\Bingo\Domain\Model\Game;

class PlayerJoinedTheGame
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
