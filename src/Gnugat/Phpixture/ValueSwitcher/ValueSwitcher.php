<?php

namespace Gnugat\Phpixture\ValueSwitcher;

class ValueSwitcher
{
    /**
     * @var array
     */
    private $strategies = array();

    /**
     * @param ValueSwitcherStrategy $valueSwitcherStrategy
     */
    public function add(ValueSwitcherStrategy $valueSwitcherStrategy)
    {
        $this->strategies[] = $valueSwitcherStrategy;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function switchValue($value)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($value)) {
                return $strategy->switchValue($value);
            }
        }
    }
}
