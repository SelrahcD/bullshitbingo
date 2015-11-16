<?php

namespace BullshitBingo\Bingo\Domain\Model\Player;

use BullshitBingo\Bingo\Domain\Model\Game\Game;
use BullshitBingo\Bingo\Domain\Model\Game\GameId;
use BullshitBingo\Bingo\Domain\Model\Theme\Theme;

class Player
{
    public function join(Game $game)
    {
        $game->accept($this);
    }

    public function createAGameUsingTheme(GameId $gameId, Theme $theme)
    {
        return Game::createUsingTheme($gameId, $this, $theme);
    }

    public function startGame(Game $game)
    {
        $game->startByUser($this);
    }
}
