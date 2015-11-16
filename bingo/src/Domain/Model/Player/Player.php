<?php

namespace BullshitBingo\Bingo\Domain\Model\Player;

use BullshitBingo\Bingo\Domain\Model\Game\Game;

class Player
{
    public function join(Game $game)
    {
        $game->accept($this);
    }
}
