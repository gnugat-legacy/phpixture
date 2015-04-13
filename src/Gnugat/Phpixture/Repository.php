<?php

namespace Gnugat\Phpixture;

class Repository
{
    /**
     * @var array
     */
    private $fixtures;

    /**
     * @param array $fixtures
     */
    public function __construct(array $fixtures)
    {
        $this->fixtures = $fixtures;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function findAll($name)
    {
        $fixtures = array();
        foreach ($this->fixtures[$name] as $fixture) {
            $fixtures[] = $fixture;
        }

        return $fixtures;
    }
}
