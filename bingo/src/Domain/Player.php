<?php

namespace BullshitBingo\Bingo\Domain;

class Player
{
    public function join(Game $game)
    {
        $game->accept($this);
    }
}
