<?php
namespace Glebstar\Sanitizer\Filter;

use Glebstar\Sanitizer\FilterInterface;

class FloatFilter implements FilterInterface
{
    public function apply($param)
    {
        if (!is_numeric($param)) return [
            'error' => 'Parameter is not a float.'
        ];

        return (float)$param;
    }
}
