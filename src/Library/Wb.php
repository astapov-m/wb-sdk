<?php

namespace Wb\Library;

use GuzzleHttp\Client;
use Wb\Config\WbConfig;

class Wb
{

    private static Client $http;
    private static array $error = [];

    public static function get(string $path = '', array $data = []) : array
    {
        try {
            $request = static::$http->request("GET", WbConfig::getConst("URL").$path,['query' => array_merge(
                ['key' => WbConfig::getConst("AUTH_KEY")],
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
            }elseif(!WbConfig::getConst('ERROR_HANDLER')){
                throw new \Exception($throwable->getMessage(), $throwable->getCode());
            }

            if(in_array($throwable->getCode(),WbConfig::getConst('ACCEPTABLE_ERROR_CODE')) && count(static::$error) < WbConfig::getConst('COUNT_ATTEMPTS')){
                static::$error[] = $thisError;
                sleep(WbConfig::getConst('ERROR_SLEEP_TIME'));
                return static::get($path,$data);
            }else{
                return count(static::$error) < WbConfig::getConst('COUNT_ATTEMPTS') ? $thisError : static::$error;
            }
        }
    }

    public static function initHttp() : void
    {
        static::$http = new Client();
    }
}