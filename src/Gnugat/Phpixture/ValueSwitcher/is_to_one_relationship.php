<?php

namespace Gnugat\Phpixture\ValueSwitcher;

/**
 * @param mixed $value
 *
 * @return bool
 */
function is_to_one_relationship($value) {
    return is_string($value) && !empty($value) && '@' === $value[0];
}
