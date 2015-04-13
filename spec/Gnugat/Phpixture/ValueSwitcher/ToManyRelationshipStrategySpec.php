<?php

namespace spec\Gnugat\Phpixture\ValueSwitcher;

use PhpSpec\ObjectBehavior;

class ToManyRelationshipStrategySpec extends ObjectBehavior
{
    function let()
    {
        $fixtures = array(
            'tags' => array(
                'news' => array(
                    'id' => 1,
                    'name' => 'news',
                    'articles' => array(
                        '@introducing_phpixtures',
                    ),
                ),
            ),
            'articles' => array(
                'introducing_phpixtures' => array(
                    'id' => 1,
                    'title' => 'Introducing Phpixture v0.1.0',
                    'content' => 'Yet another fixture library!',
                    'tag' => '@news',
                ),
            ),
        );
        $this->beConstructedWith($fixtures);
    }

    function it_is_a_value_switcher_strategy()
    {
        $this->shouldImplement('Gnugat\Phpixture\ValueSwitcher\ValueSwitcherStrategy');
    }

    function it_supports_to_many_relationships()
    {
        $value = array('@introducing_phpixtures');

        $this->supports($value)->shouldBe(true);
    }

    function it_replaces_value_with_relationship()
    {
        $value = array('@introducing_phpixtures');

        $this->switchValue($value)->shouldBe(array(
            array(
                'id' => 1,
                'title' => 'Introducing Phpixture v0.1.0',
                'content' => 'Yet another fixture library!',
            ),
        ));
    }
}
