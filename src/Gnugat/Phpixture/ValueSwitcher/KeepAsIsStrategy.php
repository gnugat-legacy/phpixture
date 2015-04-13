<?php

namespace Gnugat\Phpixture\ValueSwitcher;

class KeepAsIsStrategy implements ValueSwitcherStrategy
{
    /**
     * {@inheritDoc}
     */
    public function supports($value)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function switchValue($value)
    {
        return $value;
    }
}
