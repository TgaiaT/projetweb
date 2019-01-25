<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 23/01/2019
 * Time: 09:17
 */

namespace App\Http\Repositories;
use GuzzleHttp\Client;

class ApiRepository
{
    private static $clientOptions = [
        'base_uri' => 'api.vandeiheim.ovh:3000/',
        'headers' => [
            'Authorization' => 'admin@token',
        ]
    ];

    public static function getClient()
    {
        return new Client(ApiRepository::$clientOptions);
    }
}
