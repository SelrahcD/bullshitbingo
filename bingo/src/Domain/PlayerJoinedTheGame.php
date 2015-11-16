<?php

namespace BullshitBingo\Bingo\Domain;

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
