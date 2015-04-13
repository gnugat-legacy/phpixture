<?php

namespace spec\Gnugat\Phpixture\ValueSwitcher;

use PhpSpec\ObjectBehavior;

class ToOneRelationshipStrategySpec extends ObjectBehavior
{
    const VALUE = '@news';

    function let()
    {
        $fixtures = array('tags' => array(
            'news' => array(
                'id' => 1,
                'name' => 'news',
            )
        ));
        $this->beConstructedWith($fixtures);
    }

    function it_is_a_value_switcher_strategy()
    {
        $this->shouldImplement('Gnugat\Phpixture\ValueSwitcher\ValueSwitcherStrategy');
    }

    function it_supports_to_one_relationships()
    {
        $this->supports(self::VALUE)->shouldBe(true);
    }

    function it_replaces_value_with_relationship()
    {
        $this->switchValue(self::VALUE)->shouldBe(array(
            'id' => 1,
            'name' => 'news',
        ));
    }
}
