<?php

namespace Wb\Library;

use GuzzleHttp\Client;
use Wb\Config\WbConfigSdk;

class Wb
{

    private static Client $http;
    private static array $error = [];
    private static WbConfigSdk $wbConfig;

    public function __construct(WbConfigSdk $wbConfig)
    {
        static::$wbConfig = $wbConfig;
    }

    public static function get(string $path = '', array $data = []) : array
    {
        try {
            $request = static::$http->request("GET", static::$wbConfig->wb_api_v1_url.$path,['query' => array_merge(
                ['key' => static::$wbConfig->wb_api_v1_auth_key],
                $data,
            )])->getBody();
            $result = json_decode($request, true);
            static::$error = [];
            return $result;
        }catch (\Throwable $throwable){
            $thisError = [
                'Error' => true,
                'ErrorCode' => $throwable->getCode(),
                'ErrorMessage' => $throwable->getMessage(),
                'ErrorLine' => $throwable->getLine(),
                'ErrorFile' => $throwable->getFile()
            ];
            if(!isset(static::$http)){
                static::initHttp();
                return static::get($path,$data);
            }elseif(!static::$wbConfig->wb_api_v1_error_handler){
                throw new \Exception($throwable->getMessage(), $throwable->getCode());
            }

            if(in_array($throwable->getCode(),static::$wbConfig->wb_api_v1_acceptable_error_code) && count(static::$error) < static::$wbConfig->wb_api_v1_count_attempts_error){
                static::$error[] = $thisError;
                sleep(static::$wbConfig->wb_api_v1_error_sleep_time);
                return static::get($path,$data);
            }else{
                return count(static::$error) < static::$wbConfig->wb_api_v1_count_attempts_error ? $thisError : static::$error;
            }
        }
    }

    public static function initHttp() : void
    {
        static::$http = new Client();
    }
}