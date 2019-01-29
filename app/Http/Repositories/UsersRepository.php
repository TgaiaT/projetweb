<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 23/01/2019
 * Time: 22:57
 */

namespace App\Http\Repositories;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

class UsersRepository
{
    /*
     * Get all the users.
     */
    public static function getUsers()
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "users?precision=max";
            $users = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            //Layout the users.
            return UsersRepository::filterUsers($users);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    /*
     * Layout the raw users data to an users array.
     */
    private static function filterUsers($users)
    {
        $finalUsers =  [];
        foreach ($users as $user)
        {
            $finalUsers[$user["users:id_user"]]["id"] = $user["users:id_user"];
            $finalUsers[$user["users:id_user"]]["name"] = $user["users:name"];
            $finalUsers[$user["users:id_user"]]["lastname"] = $user["users:lastname"];
            $finalUsers[$user["users:id_user"]]["email"] = $user["users:email"];
            $finalUsers[$user["users:id_user"]]["password"] = $user["users:password"];
            $finalUsers[$user["users:id_user"]]["token"] = $user["users:token"];
            $finalUsers[$user["users:id_user"]]["rank_level"] = $user["ranks:level"];
            $finalUsers[$user["users:id_user"]]["rank_id"] = $user["ranks:id_rank"];
            $finalUsers[$user["users:id_user"]]["rank_name"] = $user["ranks:rank"];
            $finalUsers[$user["users:id_user"]]["campus_id"] = $user["campus:id_campus"];
            $finalUsers[$user["users:id_user"]]["campus_name"] = $user["campus:campus"];
        }
        return $finalUsers;
    }

    /*
     * Get all the campus.
     */
    public static function getCampus()
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "campus";
            $campus = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            return UsersRepository::filterCampus($campus);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    /*
     * Layout the raw campus data to an campus array.
     */
    private static function filterCampus($campus)
    {
        $finalCampus =  [];
        foreach ($campus as $c)
        {
            $finalCampus[$c["campus:id_campus"]]["id"] = $c["campus:id_campus"];
            $finalCampus[$c["campus:id_campus"]]["campus"] = $c["campus:campus"];
        }
        return $finalCampus;
    }

    /*
     * Get all the ranks
     */
    public static function getRanks()
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "ranks";
            $ranks = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            return UsersRepository::filterRanks($ranks);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    /*
     * Layout the raw ranks data to an ranks array.
     */
    private static function filterRanks($ranks)
    {
        $finalRanks =  [];
        foreach ($ranks as $c)
        {
            $finalRanks[$c["ranks:id_rank"]]["id"] = $c["ranks:id_rank"];
            $finalRanks[$c["ranks:id_rank"]]["name"] = $c["ranks:rank"];
            $finalRanks[$c["ranks:id_rank"]]["level"] = $c["ranks:level"];
        }
        return $finalRanks;
    }

    /*
     * Update user's information.
     */
    public static function update($id_user, $new_password, $campus, $id_rank)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "users/" . $id_user;

            /*
             * Update the campus.
             */
            if (isset($campus))
            {
                $campuses = UsersRepository::getCampus();

                foreach ($campuses as $c)
                {
                    if (strtolower($campus) == strtolower($c["campus"]))
                    {
                        $idCampus = $c["id"];
                        $res = json_decode((($client->request('PUT', $url, [
                            "json" => [
                                "values" => [
                                    "id_campus" => $idCampus,
                                ]
                            ]
                        ]))->getBody()), true);
                        break;
                    }
                }
            }
            if (isset($res["error"])) return true;

            /*
             * Update the rank.
             */
            if (isset($id_rank))
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_rank" => $id_rank,
                        ]
                    ]
                ]))->getBody()), true);
            }
            if (isset($res["error"])) return true;

            /*
             * Update the password.
             */
            if (isset($new_password))
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "password" => $new_password,
                        ]
                    ]
                ]))->getBody()), true);
            }
            if (isset($res["error"])) return true;

            if (!isset($res["error"]))
            {
                return false;
            }
            else
            {
                return true;
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }

    /*
     * Close an user account.
     */
    public static function closeAccount($id_user)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "users/" . $id_user;

            $res = json_decode((($client->request('PUT', $url, [
                "json" => [
                    "values" => [
                        "name" => "Utilisateur",
                        "lastname" => "Anonyme",
                        "password" => "" . time(),
                        "email" => "account.closed@vandeiheim.ovh",
                        "token" => "" . hash("sha256", time()),
                    ]
                ]
            ]))->getBody()), true);

            if (!isset($res["error"]))
            {
                return false;
            }
            else
            {
                return true;
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }

    /*
     * Get users information in a JSON format.
     */
    public static function formatToJson()
    {
        $json = [];
        $users = UsersRepository::getUsers();
        foreach ($users as $user)
        {
            array_push($json, [
                "id" => $user["id"],
                "name" => $user["name"],
                "lastname" => $user["lastname"],
                "email" => $user["email"],
                "rank" => $user["rank_name"],
                "rank_level" => $user["rank_level"],
            ]);
        }
        return $json;
    }

}
