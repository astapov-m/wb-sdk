<?php

namespace Wb\Entities;

use Wb\Abstracts\Entity;
use Wb\Library\Wb;

class Orders extends Entity
{
    const PATH = 'orders';

    public static function getOrders(string $dateFrom, int $flag = 0, callable $callable = null): ?array
    {
        static::$response = Wb::get(self::PATH,[
            'dateFrom' => $dateFrom,
            'flag' => $flag
        ]);

        return static::getResponse($callable);
    }

}