<?php

/**
 * echo's string with die; on exit
 */
function ed()
{
    foreach (func_get_args() as $val) {
        if (!is_object($val) && !is_array($val)) {
            echo $val;
        }
    }
    die;
}
