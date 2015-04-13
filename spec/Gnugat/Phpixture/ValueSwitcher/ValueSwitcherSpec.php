<?php

namespace spec\Gnugat\Phpixture\ValueSwitcher;

use Gnugat\Phpixture\ValueSwitcher\ValueSwitcherStrategy;
use PhpSpec\ObjectBehavior;

class ValueSwitcherSpec extends ObjectBehavior
{
    const VALUE = '@news';
    const SWITCHED_VALUE = 'Nobody expects the spanish inquisition!';

    function it_executes_appropriate_strategy(ValueSwitcherStrategy $valueSwitcherStrategy)
    {
        $this->add($valueSwitcherStrategy);
        $valueSwitcherStrategy->supports(self::VALUE)->willReturn(true);
        $valueSwitcherStrategy->switchValue(self::VALUE)->willReturn(self::SWITCHED_VALUE);

        $this->switchValue('@news')->shouldBe(self::SWITCHED_VALUE);
    }
}
