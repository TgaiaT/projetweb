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

    private static function getVoters($activities)
    {
        $client = ApiRepository::getClient();
        $filteredActivities = [];
        foreach ($activities as $activity)
        {
            $url = "activities/" . $activity["id"] . "?&getVoters=true";
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

    private static function getRegistered($activities)
    {
        $client = ApiRepository::getClient();
        $filteredActivities = [];
        foreach ($activities as $activity)
        {
            $url = "activities/" . $activity["id"] . "?&getRegistered=true";
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
