<?php
namespace Glebstar\Sanitizer;

interface FilterInterface
{
    /**
     * The method applies a filter to a parameter
     *
     * @param $param mixed
     * @return mixed
     */
    public function apply($param);
}
