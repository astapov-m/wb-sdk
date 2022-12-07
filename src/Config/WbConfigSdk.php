<?php

namespace Wb\Config;

class WbConfigSdk
{
    public function __construct(
        private string $wb_api_v1_auth_key,
        private string $wb_api_v1_url = 'https://suppliers-stats.wildberries.ru/api/v1/supplier/',
        private array $wb_api_v1_acceptable_error_code = [429],
        private int $wb_api_v1_error_sleep_time = 8,
        private bool $wb_api_v1_error_handler = true,
        private int $wb_api_v1_count_attempts_error = 3,
    ){}

    public function __get(string $name) : mixed
    {
        return $this->$name;
    }

    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }
}