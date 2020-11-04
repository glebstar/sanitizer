<?php
namespace Glebstar\Sanitizer\Filter;

use Glebstar\Sanitizer\FilterInterface;

class IntegerFilter implements FilterInterface
{
    public function apply($param)
    {
        if (!$this->isInteger($param)) return [
            'error' => 'Parameter is not a int.'
        ];

        return (int)$param;
    }

    private function isInteger($input){
        return(ctype_digit(strval($input)));
    }
}
