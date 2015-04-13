<?php

namespace Gnugat\Phpixture;

use Gnugat\Phpixture\ValueSwitcher\KeepAsIsStrategy;
use Gnugat\Phpixture\ValueSwitcher\ToManyRelationshipStrategy;
use Gnugat\Phpixture\ValueSwitcher\ToOneRelationshipStrategy;
use Gnugat\Phpixture\ValueSwitcher\ValueSwitcher;

class Repository
{
    /**
     * @var array
     */
    private $fixtures;

    /**
     * @var ValueSwitcher
     */
    private $valueSwitcher;

    /**
     * @param array $fixtures
     */
    public function __construct(array $fixtures)
    {
        $this->fixtures = $fixtures;
        $this->valueSwitcher = new ValueSwitcher();
        $this->valueSwitcher->add(new ToManyRelationshipStrategy($fixtures));
        $this->valueSwitcher->add(new ToOneRelationshipStrategy($fixtures));
        $this->valueSwitcher->add(new KeepAsIsStrategy());
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
            $switchedFields = array();
            foreach ($fixture as $name => $value) {
                $switchedFields[$name] = $this->valueSwitcher->switchValue($value);
            }
            $fixtures[] = $switchedFields;
        }

        return $fixtures;
    }
}
