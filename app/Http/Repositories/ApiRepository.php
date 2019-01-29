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
    /*
     * Information used to communicate to the API.
     */
    private static $clientOptions = [
        'base_uri' => 'api.vandeiheim.ovh:3000/',
        'headers' => [
            'Authorization' => 'admin@token',
        ]
    ];

    /*
     * Get the client used to communicate to the API.
     */
    public static function getClient()
    {
        return new Client(ApiRepository::$clientOptions);
    }
}
