<?php
namespace Glebstar\Sanitizer\Filter;

use Glebstar\Sanitizer\FilterInterface;

class StringFilter implements FilterInterface
{
    public function apply($param)
    {
        if (!is_string($param)) return [
            'error' => 'Parameter is not a string.'
        ];

        return $param;
    }
}