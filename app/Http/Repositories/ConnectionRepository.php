<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 23/01/2019
 * Time: 09:10
 */

namespace App\Repositories\Http;

use App\Http\Repositories\ApiRepository;
use GuzzleHttp\Client;

class ConnectionRepository {

    public static function getConnection($login, $password)
    {
        $client = ApiRepository::getClient();
        $res = json_decode((($client->request('GET', 'users?precision=max'))->getBody()), true);
        if (ConnectionRepository::hasErrors($res) || count($res["result"]) == 0)
        {
            return null;
        }
        $res = $res["result"];
        foreach ($res as $row)
        {
            if ($row["users:email"] == $login && $row["users:password"] == hash('sha256', $password))
            {
                return $row;
            }
        }
        return null;
    }

    public static function registerUser($name, $lastname, $email, $password, $campusName)
    {
        $client = ApiRepository::getClient();

        /*
         * Get the campus ID
         */
        $campus = json_decode((($client->request('GET', 'campus'))->getBody()), true)["result"];
        $campusId = $campus[0]["campus:id_campus"];
        foreach ($campus as $c)
        {
            if ($c["campus:campus"] == $campusName)
            {
                $campusId = $c["campus:id_campus"];
                break;
            }
        }

        /*
         * Get the rank ID
         */
        $ranks = json_decode((($client->request('GET', 'ranks'))->getBody()), true)["result"];
        $rankId = 0;
        $rankLevel = 0;
        foreach ($ranks as $r)
        {
            if ($r["ranks:rank"] == "student")
            {
                $rankId = $r["ranks:id_rank"];
                $rankLevel = $r["ranks:level"];
                break;
            }
        }

        /*
         * Check if the user wasn't registered
         */
        $isRegistered = json_decode((($client->request('GET', 'users'))->getBody()), true)["result"];
        foreach ($isRegistered as $i)
        {
            if ($i["users:email"] == $email)
            {
                return null;
            }
        }

        /*
         * Store the new user
         */
        $token = hash('sha256', "" . time());
        $result = json_decode((($client->request('POST', 'users', [
            'json' => [
                "values" => [
                    "name" => $name,
                    "lastname" => $lastname,
                    "email" => $email,
                    "password" => $password,
                    "token" => $token,
                    "id_campus" => $campusId,
                    "id_rank" => $rankId
                ]
            ]
        ]))->getBody()), true);

        if (ConnectionRepository::hasErrors($result))
        {
            return null;
        }
        else
        {
            $users = json_decode((($client->request('GET', 'users'))->getBody()), true)["result"];
            $userId = 0;
            foreach ($users as $i)
            {
                if ($i["users:email"] == $email)
                {
                    $userId = $i["users:id_user"];
                }
            }

            if ($userId == 0)
            {
                return null;
            }
            else
            {
                return [
                    "id_user" => $userId,
                    "token" => $token,
                    "id_campus" => $campusId,
                    "id_rank" => $rankId,
                    "rank_level" => $rankLevel
                ];
            }
        }
    }


    private static function hasErrors($response)
    {
        if (isset($response['error']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
