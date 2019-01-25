<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 24/01/2019
 * Time: 14:39
 */

namespace App\Http\Repositories;


class EventsRepository
{
    public static function getEvents()
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "manifestations?precision=max";
            $events = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            return EventsRepository::filterEvents($events);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    public static function createEvent($name, $description, $date, $price, $location)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "manifestations";
            $event = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "event_name" => $name,
                        "event_description" => $description,
                        "event_price" => $price,
                        "event_date" => $date,
                        "event_location" => $location,
                        "id_state" => 1,
                    ]
                ]
            ]))->getBody()), true);
            if (!isset($event["error"]))
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

    public static function filterByDate($events, $filter, $limit)
    {
        $filteredEvents = [];
        $actualTime = time();
        foreach ($events as $event)
        {
            if (isset($filter) && $filter == "future")
            {
                if (strtotime($event["date"]) > $actualTime)
                {
                    if (isset($limit) && strtotime($event["date"]) <= $actualTime + $limit)
                    {
                        array_push($filteredEvents, $event);
                    }
                    elseif (!isset($limit))
                    {
                        array_push($filteredEvents, $event);
                    }
                }
            }
            elseif (isset($filter) && $filter == "past")
            {
                if (strtotime($event["date"]) <= $actualTime)
                {
                    if (isset($limit) && strtotime($event["date"]) >= $actualTime - $limit)
                    {
                        array_push($filteredEvents, $event);
                    }
                    elseif (!isset($limit))
                    {
                        array_push($filteredEvents, $event);
                    }
                }
            }
        }
        return $filteredEvents;
    }

    private static function filterEvents($events)
    {
        $filteredEvents =  [];
        foreach ($events as $event)
        {
            $filteredEvents[$event["manifestations:id_event"]]["id"] = $event["manifestations:id_event"];
            $filteredEvents[$event["manifestations:id_event"]]["name"] = $event["manifestations:event_name"];
            $filteredEvents[$event["manifestations:id_event"]]["date"] = $event["manifestations:event_date"];
            $filteredEvents[$event["manifestations:id_event"]]["price"] = $event["manifestations:event_price"];
            $filteredEvents[$event["manifestations:id_event"]]["description"] = $event["manifestations:event_description"];
            $filteredEvents[$event["manifestations:id_event"]]["location"] = $event["manifestations:event_location"];
            $filteredEvents[$event["manifestations:id_event"]]["state"] = $event["states:state"];
        }
        $filteredEvents = EventsRepository::getActivities($filteredEvents);
        $filteredEvents = EventsRepository::getPictures($filteredEvents);
        return $filteredEvents;
    }

    private static function getActivities($events)
    {
        $client = ApiRepository::getClient();
        $filteredEvents = [];
        foreach ($events as $event)
        {
            $url = "manifestations/" . $event["id"] . "?precision=max&getActivities=true";
            $activities = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $event["activities"] = [];
            foreach ($activities as $activity)
            {
                $event["activities"][$activity["activities:id_activity"]]["id"] = $activity["activities:id_activity"];
                $event["activities"][$activity["activities:id_activity"]]["name"] = $activity["activities:activity_name"];
                $event["activities"][$activity["activities:id_activity"]]["description"] = $activity["activities:activity_description"];
                $event["activities"][$activity["activities:id_activity"]]["creator"] = $activity["activities:id_user"];
            }
            array_push($filteredEvents, $event);
        }
        return $filteredEvents;
    }

    private static function getPictures($events)
    {
        $client = ApiRepository::getClient();
        $filteredEvents = [];
        foreach ($events as $event)
        {
            $url = "manifestations/" . $event["id"] . "?precision=max&getPictures=true";
            $pictures = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $event["pictures"] = [];
            foreach ($pictures as $picture)
            {
                $event["pictures"][$picture["pictures:id_picture"]]["id"] = $picture["pictures:id_picture"];
                $event["pictures"][$picture["pictures:id_picture"]]["url"] = $picture["pictures:picture_url"];
                $event["pictures"][$picture["pictures:id_picture"]]["id_state"] = $picture["states:id_state"];
                $more = PicturesRepository::getPictures($picture["pictures:id_picture"]);
                $event["pictures"][$picture["pictures:id_picture"]]["comments"] = $more[0]["comments"];
                $event["pictures"][$picture["pictures:id_picture"]]["likes"] = count($more[0]["liked"]);

            }
            array_push($filteredEvents, $event);
        }
        return $filteredEvents;
    }
}
