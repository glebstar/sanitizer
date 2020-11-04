<?php
namespace Glebstar\Sanitizer\Filter;

use Glebstar\Sanitizer\FilterInterface;

class PhoneFilter implements FilterInterface
{
    public function apply($param)
    {
        if (!preg_match('/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/', $param)) return [
            'error' => 'Parameter is not a phone.'
        ];

        $param = preg_replace('/[^\d]/', '', $param);
        $param = preg_replace('/^8/', 7, $param);

        return $param;
    }
}
