<?php

namespace Gnugat\Phpixture\ValueSwitcher;

class ToOneRelationshipStrategy implements ValueSwitcherStrategy
{
    /**
     * @var array
     */
    private $fixtures;

    public function __construct(array $fixtures)
    {
        $this->fixtures = $fixtures;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($value)
    {
        return is_string($value) && !empty($value) && $value[0];
    }

    /**
     * {@inheritDoc}
     */
    public function switchValue($value)
    {
        $name = substr($value, 1);
        foreach ($this->fixtures as $fixtures) {
            if (isset($fixtures[$name])) {
                return $fixtures[$name];
            }
        }

        return $value;
    }
}
