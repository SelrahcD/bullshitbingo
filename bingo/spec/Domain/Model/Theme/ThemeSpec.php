<?php

namespace spec\BullshitBingo\Bingo\Domain\Model\Theme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ThemeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BullshitBingo\Bingo\Domain\Model\Theme\Theme');
    }

    function let()
    {
        $this->beConstructedThrough('named', ['Marketing']);
    }
}
