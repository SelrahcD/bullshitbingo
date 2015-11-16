<?php

namespace BullshitBingo\Bingo\Domain;

use Ramsey\Uuid\Uuid;

class GameId
{
    /**
     * @var Uuid
     */
    private $uuid;

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function generate()
    {
        return new GameId(Uuid::uuid4());
    }

    public function equals(GameId $gameId)
    {
        return $this == $gameId;
    }
}
