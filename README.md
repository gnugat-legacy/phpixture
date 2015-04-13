# Phpixture

Create fixtures for your tests by constructing array:

```php
<?php

require __DIR__.'/vendor/autoload.php';

$fixtures = array(
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
            'tag' => '@news',
        ),
    ),
);

$repository = new Gnugat\Phpixture\Repository($fixtures);

$articles = $repository->findAll('articles');
// array(
//     array(
//         'id' => 1,
//         'title' => 'Introducing Phpixture',
//         'content' => 'Yet another fixture library!',
//         'tag' => array(
//             'id' => 1,
//             'name' => 'news',
//         ),
//     )
// )
```

![Yet another fixture library](http://imgs.xkcd.com/comics/standards.png)

## Installation

Use [Composer](https://getcomposer.org/) to install this library in your projects:

    composer require gnugat/phpixture:~0.1.0@dev

## FAQ

### How do we pronounce Phpixture?

PHP Fixture.

### Why should I use it instead of X?

No reason, Phpixture is more a pet project / proof of concept than a library you'd
use in production. But I'd be happy if you find it useful!

### How do I store fixtures in a PHP file?

Say you store them like this:

```php
<?php
// File: fixtures.php

return $fixtures = array(
    'articles' => array(
        'introducing_phpixtures' => array(
            'id' => 1,
            'title' => 'Introducing Phpixture',
            'content' => 'Yet another fixture library!',
        ),
    ),
);
```

Then you can get them like this:

```php
<?php

require __DIR__.'/vendor/autoload.php';

$fixtures = include __DIR__.'/fixtures.php';
$repository = new Gnugat\Phpixture\Repository($fixtures);
```

### How do I store fixtures in a YAML file?

Say you store them like this:

```
// File: fixtures.yaml
articles:
    introducing_phpixtures:
        id: 1
        title: 'Introducing Phpixture'
        content: 'Yet another fixture library!'
```

Then you can get them like this:

```php
<?php

require __DIR__.'/vendor/autoload.php';

$fixtures = Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__.'/fixtures.yaml'));
$repository = new Gnugat\Phpixture\Repository($fixtures);
```

>> **Note**: You'd need to install [Symfony Yaml Component](http://symfony.com/doc/master/components/yaml/introduction.html).

### How do I store fixtures in a JSON file?

Say you store them like this (file: `fixtures.json`):

```
{
    'articles': {
        'introducing_phpixtures': {
            'id': 1,
            'title': 'Introducing Phpixture',
            'content': 'Yet another fixture library!'
        }
    }
}
```

Then you can get them like this:

```php
<?php

require __DIR__.'/vendor/autoload.php';

$fixtures = json_decode(file_get_contents(__DIR__.'/fixtures.json'), true);
$repository = new Gnugat\Phpixture\Repository($fixtures);
```

### How do I store fixtures in a XML file?

I'm sure you start to get the picture. Find a XML library, parse the file and
transform it in an array.

### How do I store fixtures in annotations?

Errr... I'm sure you'll find a way (if you do please tell me :) ).

### How do I create objects from those fixtures?

Loop over each fixture and instanciate your object:

```php
<?php

require __DIR__.'/vendor/autoload.php';

$fixtures = Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__.'/fixtures.yaml'));
$repository = new Gnugat\Phpixture\Repository($fixtures);

$articles = array();
foreach ($repository->findAll('articles') as $articleFixture) {
    $article = new Article($articleFixture['title'], $articleFixture['content']);

    // Assuming Article#id is private, doesn't have setter and cannot be set from constructor
    $reflectedArticle = new ReflectionClass($article);
    $id = $reflectedArticle->getProperty('id');
    $id->setAccessible(true);
    $id->setValue($articleFixture['id']);
}
```

### How do I create entities using DoctrineDataFixtures?

Well, same as above:

```php
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gnugat\Phpixture\Repository;
use Symfony\Component\Yaml\Yaml;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $fixtures = Yaml::parse(file_get_contents(__DIR__.'/fixtures.yaml'));
        $repository = new Repository($fixtures);
        foreach ($repository->findAll('articles') as $articleFixture) {
            $article = new Article($articleFixture['title'], $articleFixture['content']);

            // Assuming Article#id is private, doesn't have setter and cannot be set from constructor
            $reflectedArticle = new ReflectionClass($article);
            $id = $reflectedArticle->getProperty('id');
            $id->setAccessible(true);
            $id->setValue($articleFixture['id']);

            $manager->persist($article);
        }
        $manager->flush();
    }
}
```

## Want to know more?

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/gnugat/phpixture/releases)
* the file listing the [changes between versions](CHANGELOG.md)

And finally some meta documentation:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)
