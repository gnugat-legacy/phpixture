<?php

namespace spec\Gnugat\Phpixture;

use PhpSpec\ObjectBehavior;

class RepositorySpec extends ObjectBehavior
{
    function it_finds_all_fixture_for_given_key()
    {
        $this->beConstructedWith(array(
            'tags' => array(
                'news' => array(
                    'id' => 1,
                    'name' => 'news',
                ),
            ),
            'articles' => array(
                'introducing_phpixtures' => array(
                    'id' => 1,
                    'title' => 'Introducing Phpixture',
                    'content' => 'Yet another fixture library!',
                ),
            ),
        ));

        $this->findAll('articles')->shouldBe(array(
            array(
                'id' => 1,
                'title' => 'Introducing Phpixture',
                'content' => 'Yet another fixture library!',
            ),
        ));
    }
}
