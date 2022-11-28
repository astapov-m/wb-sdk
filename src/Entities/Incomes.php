<?php

namespace Wb\Entities;

use Wb\Abstracts\Entity;
use Wb\Library\Wb;

class Incomes extends Entity
{
    private const PATH = 'incomes';

    public static function getIncomes(string $dateFrom , callable $callable = null): ?array
    {
        static::$response = Wb::get(self::PATH,[
            'dateFrom' => $dateFrom
        ]);
        return static::getResponse($callable);
    }
}