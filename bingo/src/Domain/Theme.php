<?php

namespace BullshitBingo\Bingo\Domain;

class Theme
{

    private function __construct()
    {
    }

    public static function named($themeName)
    {
        return new Theme();
    }

}
