# PHP7 Sanitizer
Package for transforms data according to filters

## Install
`composer require glebstar/sanitizer`

## Available filters
+ string
+ integer
+ float
+ phone

## Examples

```php
<?php

use Glebstar\Sanitizer\Sanitizer;

class Example
{
    public function testSanitize()
    {
        $sanitizer = new Sanitizer();
        $filters = [
            'foo' => 'integer',
            'bar' => 'string',
            'baz' => 'phone',
        ];
        $data = json_encode([
            'foo' => '123',
            'bar' => 'asd',
            'baz' => '8 (950) 288-56-23',
        ]);
    
        $result = $sanitizer->sanitize($filters, $data);
    }
}
```