<?php

namespace Gnugat\Phpixture\ValueSwitcher;

interface ValueSwitcherStrategy
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function supports($value);

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function switchValue($value);
}
