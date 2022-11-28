<?php

namespace Wb\Entities;

use Wb\Abstracts\Entity;
use Wb\Library\Wb;

class ReportDetailByPeriod extends Entity
{
    const PATH = 'reportDetailByPeriod';

    public static function getReportDetailByPeriod(string $dateFrom, string $dateTo, int $limit, int $rrdid, callable $callable = null): ?array
    {
        static::$response = Wb::get(self::PATH,[
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'limit' => $limit,
            'rrdid' => $rrdid,
        ]);

        return static::getResponse();
    }
}