@bingo
Feature:
  As a player
  I want to create a new game

  Background:
    Given that a theme "Marketing" exists

  Scenario: I create a game using an existing theme
    When I create a game using the theme "Marketing"
    Then I'm notified that a new game has been created
    And I should see that this game is opened