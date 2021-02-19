<?php

function validName($name)
{
    return !empty($name);
}

/**validOpt returns true if the condiments are in the list of valid options
 * @param $selected
 * @return bool
 */
function validOpt($selected)
{
    $validOpt = getOptions();
    foreach ($selected as $option) {
        if (!(in_array($option, $validOpt))) {
            return false;
        }
    }
    return true;
}
