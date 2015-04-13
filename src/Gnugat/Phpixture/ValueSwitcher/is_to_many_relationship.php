<?php

namespace Gnugat\Phpixture\ValueSwitcher;

/**
 * @param mixed $value
 *
 * @return bool
 */
function is_to_many_relationship($value) {
    return is_array($value) && !empty($value) && is_to_one_relationship($value[0]);
}
