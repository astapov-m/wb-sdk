<?php

namespace Wb\Abstracts;

abstract class Entity
{
    protected static array $response;

    protected static function runCallBack(callable $callback = null): void
    {
        if(!is_null($callback)) {
            $callback(static::$response);
        }
    }

    public static function getResponse(callable $callback = null): ?array
    {
        static::runCallBack($callback);
        return static::$response ?? null;
    }
}