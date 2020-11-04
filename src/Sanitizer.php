<?php

namespace Glebstar\Sanitizer;

use Glebstar\Sanitizer\Filter\{StringFilter, IntegerFilter, FloatFilter, PhoneFilter};

class Sanitizer
{
    private $availableFilters = [
        'string' => StringFilter::class,
        'integer' => IntegerFilter::class,
        'float' => FloatFilter::class,
        'phone' => PhoneFilter::class,
    ];

    /**
     * Method transforms data according to filters
     *
     * @param $filters array
     * @param $data string json format data
     * @return array
     */
    public function sanitize(array $filters, string $data)
    {
        $data = json_decode($data, true);
        if (!$data) {
            return ['error' => ['system' => 'Invalid json.']];
        }

        foreach ($filters as $key => $filter) {
            if (isset($data[$key])) {
                if (isset($this->availableFilters[$filter])) {
                    $f = new $this->availableFilters[$filter]();
                    $data[$key] = $f->apply($data[$key]);
                } else {
                    return ['error' => ['system' => "Not available filter {$key}."]];
                }
            }
        }

        $errors = [];
        foreach ($data as $key => $item) {
            if (is_array($item) && key_exists('error', $item)) {
                $errors[$key] = $item['error'];
            }
        }

        if (!empty($errors)) {
            return ['error' => $errors];
        }

        return $data;
    }
}
