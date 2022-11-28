<?php

namespace Wb\Entities;

use Wb\Abstracts\Entity;
use Wb\Library\Wb;

class Stocks extends Entity
{
    const PATH = 'stocks';

    public static function getStocks(string $dateFrom, callable $callable = null): ?array
    {
        static::$response = Wb::get(self::PATH,[
            'dateFrom' => $dateFrom
        ]);

        return  static::getResponse($callable);
    }
}