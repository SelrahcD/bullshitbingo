@bingo
Feature:
  As the player who created a game
  I want to start it

  Background:
    Given that a theme "Marketing" exists
    And that I created a game using the theme "Marketing"

  Scenario: I join an existing game
    When I start the game
    Then I should be notified that the game is started