<?php

namespace Wb\Entities;

use Wb\Abstracts\Entity;
use Wb\Library\Wb;

class ExciseGoods extends Entity
{
    const PATH = 'excise-goods';

    public function getExciseGoods(string $dateFrom, callable $callable = null): ?array
    {
        static::$response = Wb::get(self::PATH,[
            'dateFrom' => $dateFrom
        ]);
        return  static::getResponse($callable);
    }
}