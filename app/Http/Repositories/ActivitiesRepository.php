<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 24/01/2019
 * Time: 21:25
 */

namespace App\Http\Repositories;


class ActivitiesRepository
{
    public static function getActivities()
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "activities?precision=max";
            $activities = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            return ActivitiesRepository::filterActivities($activities);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    public static function createActivity($name, $description, $id_event, $id_user)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "activities";
            $activities = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "activity_name" => $name,
                        "activity_description" => $description,
                        "id_user" => $id_user,
                        "id_event" => $id_event,
                        "id_state" => 3,
                    ]
                ]
            ]))->getBody()), true);
            if (!isset($activities["error"]))
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

    public static function updateActivity($id_activity, $id_event)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "activities/" . $id_activity;
            $activities = json_decode((($client->request('PUT', $url, [
                "json" => [
                    "values" => [
                        "id_event" => $id_event,
                        "id_state" => 1
                    ]
                ]
            ]))->getBody()), true);
            if (!isset($activities["error"]))
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

    public static function ban($id_activity, $ban)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "activities/" . $id_activity;
            if ($ban)
            {
                $activities = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 2
                        ]
                    ]
                ]))->getBody()), true);
            }
            else
            {
                $activities = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 3
                        ]
                    ]
                ]))->getBody()), true);
            }

            if (!isset($activities["error"]))
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

    public static function vote($id_user, $id_activity, $add)
    {
        $client = ApiRepository::getClient();
        try
        {

            if ($add)
            {
                $url = "vote";
                $activities = json_decode((($client->request('POST', $url, [
                    "json" => [
                        "values" => [
                            "id_activity" => $id_activity,
                            "id_user" => $id_user
                        ]
                    ]
                ]))->getBody()), true);
            }
            else
            {
                $url = "vote/" . $id_activity . "/" . $id_user;
                $activities = json_decode((($client->request('DELETE', $url))->getBody()), true);
            }

            if (!isset($activities["error"]))
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

    public static function register($id_user, $id_activity, $register)
    {
        $client = ApiRepository::getClient();
        try
        {

            if ($register)
            {
                $url = "signin";
                $activities = json_decode((($client->request('POST', $url, [
                    "json" => [
                        "values" => [
                            "id_activity" => $id_activity,
                            "id_user" => $id_user
                        ]
                    ]
                ]))->getBody()), true);
            }
            else
            {
                $url = "signin/" . $id_activity . "/" . $id_user;
                $activities = json_decode((($client->request('DELETE', $url))->getBody()), true);
            }

            if (!isset($activities["error"]))
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

    private static function filterActivities($activities)
    {
        $filteredActivities =  [];
        foreach ($activities as $activity)
        {
            $filteredActivities[$activity["activities:id_activity"]]["id"] = $activity["activities:id_activity"];
            $filteredActivities[$activity["activities:id_activity"]]["name"] = $activity["activities:activity_name"];
            $filteredActivities[$activity["activities:id_activity"]]["description"] = $activity["activities:activity_description"];
            $filteredActivities[$activity["activities:id_activity"]]["creator"] = $activity["activities:id_user"];
            $filteredActivities[$activity["activities:id_activity"]]["event"] = $activity["activities:id_event"];
            $filteredActivities[$activity["activities:id_activity"]]["state"] = $activity["states:state"];
        }
        $filteredActivities = ActivitiesRepository::getRegistered($filteredActivities);
        $filteredActivities = ActivitiesRepository::getVoters($filteredActivities);
        return $filteredActivities;
    }

    public static function getVoters($activities)
    {
        $client = ApiRepository::getClient();
        $filteredActivities = [];
        foreach ($activities as $activity)
        {
            $url = "activities/" . $activity["id"] . "?getVoters=true";
            $voters = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $activity["voters"] = [];
            foreach ($voters as $voter)
            {
                array_push($activity["voters"], $voter["vote:id_user"]);
            }
            array_push($filteredActivities, $activity);
        }
        return $filteredActivities;
    }

    public static function getRegistered($activities)
    {
        $client = ApiRepository::getClient();
        $filteredActivities = [];
        foreach ($activities as $activity)
        {
            $url = "activities/" . $activity["id"] . "?getRegistered=true";
            $registered = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $activity["registered"] = [];
            foreach ($registered as $register)
            {
                array_push($activity["registered"], $register["signin:id_user"]);
            }
            array_push($filteredActivities, $activity);
        }
        return $filteredActivities;
    }
}
