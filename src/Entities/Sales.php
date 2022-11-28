<?php

namespace Wb\Entities;

use Wb\Abstracts\Entity;
use Wb\Library\Wb;

class Sales extends Entity
{
    const PATH = 'sales';

    public static function getSales(string $dateFrom,int $flag = 0, callable $callable = null): ?array
    {
        static::$response = Wb::get(self::PATH,[
            'dateFrom' => $dateFrom,
            'flag' => $flag
        ]);

        return static::getResponse($callable);
    }
}