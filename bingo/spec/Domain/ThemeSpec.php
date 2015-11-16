<?php

namespace spec\BullshitBingo\Bingo\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ThemeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Theme');
    }

    function let()
    {
        $this->beConstructedThrough('named', ['Marketing']);
    }
}
