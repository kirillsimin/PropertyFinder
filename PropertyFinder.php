<?php
namespace PropertyFinder;

/**
 * Property Finder recursively traverses an iterable object
 * and returns an array of found properties by key name.
 *
 * $first is an optional parameter, which forces only
 * the first result to be returned.
 */
class PropertyFinder
{
    public function get($haystack = [], $needle = '', $first = false)
    {
        return array_filter($this->traverse($haystack, $needle, $first), function ($value) {
            return !empty($value);
        });
    }

    protected function traverse($haystack, $needle, $first, $result = [])
    {
        if (! is_iterable($haystack)) {
            var_dump($haystack);
            return null;
        }

        foreach ($haystack as $key => $val) {
            if ($key === $needle) {
                if ($first) {
                    return [$val];
                } else {
                    $result[] = $val;
                }
            } else {
                $foundProperty = $this->traverse($val, $needle, $first, $result);
                if (!is_null($foundProperty)) {
                    $result = $foundProperty;
                }
            }
        }

        return $result;
    }
}
