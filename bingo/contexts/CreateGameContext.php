<?php

namespace BullshitBingo\Bingo\Features\Contexts;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use BullshitBingo\Bingo\Domain\Game;
use BullshitBingo\Bingo\Domain\GameHasBeenCreated;
use BullshitBingo\Bingo\Domain\GameId;
use BullshitBingo\Bingo\Domain\Player;
use BullshitBingo\Bingo\Domain\PlayerJoinedTheGame;
use BullshitBingo\Bingo\Domain\Theme;

/**
 * Defines application features from the specific context.
 */
class CreateGameContext implements Context, SnippetAcceptingContext
{
    /**
     * @var array
     */
    private $themes;

    /**
     * @var GameId
     */
    private $gameId;

    /**
     * @var Game
     */
    private $game;
    /**
     * @var Player
     */
    private $player;

    /**
     * CreateGameContext constructor.
     */
    public function __construct()
    {
        $this->player = new Player;
    }

    /**
     * @Transform :theme
     */
    public function castThemeNameToTheme($themeName)
    {
        return Theme::named($themeName);
    }

    /**
     * @Given that a theme :theme exists
     */
    public function thatAThemeExists($theme)
    {
        $this->themes[] = $theme;
    }

    /**
     * @When I create a game using the theme :theme
     * @Given that a game using the theme :theme was created
     */
    public function iCreateAGameUsingTheTheme($theme)
    {
        $this->gameId = GameId::generate();
        $this->game = Game::createUsingTheme($this->gameId, $theme);
    }

    /**
     * @Then I'm notified that a new game has been created
     */
    public function iMNotifiedThatANewGameHasBeenCreated()
    {
        $events = $this->game->releaseEvents();
        \PHPUnit_Framework_Assert::assertNotFalse(array_search(new GameHasBeenCreated, $events));
    }

    /**
     * @Then I should see that this game is opened
     */
    public function iShouldSeeThatThisGameIsOpened()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->game->isOpened());
    }


    /**
     * @When I try to join the game
     */
    public function iTryToJoinTheGame()
    {
        $this->player->join($this->game);
    }

    /**
     * @Then I should be notified that I joined the game
     */
    public function iShouldBeNotifiedThatIJoinedTheGame()
    {
        $events = $this->game->releaseEvents();

        \PHPUnit_Framework_Assert::assertNotFalse(
            array_search(
                new PlayerJoinedTheGame($this->gameId),
                $events
            )
        );
    }

    /**
     * @Then game's player count is :playersCount
     */
    public function thatGameSPlayerCountIs($playersCount)
    {
        \PHPUnit_Framework_Assert::equalTo($playersCount, $this->game->playerCount());
    }
}
