<?php

namespace Gnugat\Phpixture\ValueSwitcher;

/**
 * @param array $fields
 *
 * @return array
 */
function filter_relationship(array $fields) {
    $filteredFields = array();
    foreach ($fields as $name => $value) {
        if (!is_to_one_relationship($value) && !is_to_many_relationship($value)) {
            $filteredFields[$name] = $value;
        }
    }

    return $filteredFields;
}
