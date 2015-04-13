<?php

namespace spec\Gnugat\Phpixture\ValueSwitcher;

use PhpSpec\ObjectBehavior;

class KeepAsIsStrategySpec extends ObjectBehavior
{
    const VALUE = 42;

    function it_is_a_value_switcher_strategy()
    {
        $this->shouldImplement('Gnugat\Phpixture\ValueSwitcher\ValueSwitcherStrategy');
    }

    function it_supports_anything()
    {
        $this->supports(self::VALUE)->shouldBe(true);
    }

    function it_keeps_value_as_is()
    {
        $this->switchValue(self::VALUE)->shouldBe(self::VALUE);
    }
}
