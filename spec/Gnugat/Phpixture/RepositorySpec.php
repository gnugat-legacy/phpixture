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
                    'articles' => array(
                        '@introducing_phpixtures',
                        '@phpixtures_v0_2_0',
                        '@phpixtures_v0_3_0',
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
                'phpixtures_v0_2_0' => array(
                    'id' => 2,
                    'title' => 'Phpixture v0.2.0',
                    'content' => 'Added ToOne relationship management',
                    'tag' => '@news',
                ),
                'phpixtures_v0_3_0' => array(
                    'id' => 3,
                    'title' => 'Phpixture v0.3.0',
                    'content' => 'Added ToMany relationship management',
                    'tag' => '@news',
                ),
            ),
        ));

        $this->findAll('articles')->shouldBe(array(
            array(
                'id' => 1,
                'title' => 'Introducing Phpixture v0.1.0',
                'content' => 'Yet another fixture library!',
                'tag' => array(
                    'id' => 1,
                    'name' => 'news',
                ),
            ),
            array(
                'id' => 2,
                'title' => 'Phpixture v0.2.0',
                'content' => 'Added ToOne relationship management',
                'tag' => array(
                    'id' => 1,
                    'name' => 'news',
                ),
            ),
            array(
                'id' => 3,
                'title' => 'Phpixture v0.3.0',
                'content' => 'Added ToMany relationship management',
                'tag' => array(
                    'id' => 1,
                    'name' => 'news',
                ),
            ),
        ));
        $this->findAll('tags')->shouldBe(array(
            array(
                'id' => 1,
                'name' => 'news',
                'articles' => array(
                    array(
                        'id' => 1,
                        'title' => 'Introducing Phpixture v0.1.0',
                        'content' => 'Yet another fixture library!',
                    ),
                    array(
                        'id' => 2,
                        'title' => 'Phpixture v0.2.0',
                        'content' => 'Added ToOne relationship management',
                    ),
                    array(
                        'id' => 3,
                        'title' => 'Phpixture v0.3.0',
                        'content' => 'Added ToMany relationship management',
                    ),
                ),
            ),
        ));
    }
}
