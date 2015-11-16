@bingo
Feature:
  As a player
  I want to join a game

  Background:
    Given that a theme "Marketing" exists
    And that a game using the theme "Marketing" was created

  Scenario: I join an existing game
    When I try to join the game
    Then I should be notified that I joined the game
    And game's player count is 1