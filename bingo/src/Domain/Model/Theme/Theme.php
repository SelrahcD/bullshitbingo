<?php
namespace BullshitBingo\Bingo\Domain\Model\Theme;

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
