<?php

namespace Wb\Config;

class WbConfig
{
    private const URL = 'https://suppliers-stats.wildberries.ru/api/v1/supplier/';
    private const AUTH_KEY = '';
    private const ACCEPTABLE_ERROR_CODE = [429];
    private const ERROR_SLEEP_TIME = 8;
    private const ERROR_HANDLER = true;
    private const COUNT_ATTEMPTS = 3;

    public static function getConst($name) {
        return constant("self::{$name}");
    }
}