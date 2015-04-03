<?php
function RemoveKeys(array $keys, array $target)
{
    return array_diff_key($target, array_flip($keys));
}