<?php

namespace Gnugat\Phpixture\ValueSwitcher;

class ToManyRelationshipStrategy implements ValueSwitcherStrategy
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
        return is_to_many_relationship($value);
    }

    /**
     * {@inheritDoc}
     */
    public function switchValue($value)
    {
        $switchedValue = array();
        foreach ($value as $subValue) {
            $name = substr($subValue, 1);
            foreach ($this->fixtures as $fixtures) {
                if (isset($fixtures[$name])) {
                    $switchedValue[] = filter_relationship($this->fixtures, $fixtures[$name]);
                }
            }
        }

        return $switchedValue;
    }
}
