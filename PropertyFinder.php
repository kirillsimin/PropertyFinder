<?php

namespace PropertyFinder;

class PropertyFinder
{

    public function __construct()
    {
        //
    }

    public static function get($object, $propertyName, $single = false, $result = [])
    {
        foreach ($object as $key => $val) {
            if ($key === $propertyName) {
                if ($single) {
                    $result = $val;
                } else {
                    $result[$key] = $val;
                }
            } elseif (is_object($val) || is_array($val)) {
                $temp = extractProperties($val, $propertyName);
                if ($single) {
                    !empty($temp) ? $result = $temp : null;
                } else {
                    !empty($temp) ? $result[$key] = $temp : null;
                }
            }
        }
        return $result;
    }
}
