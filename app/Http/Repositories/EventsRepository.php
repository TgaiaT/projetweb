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
                $comments = PicturesRepository::getPictures($picture["pictures:id_picture"]);
                $event["pictures"][$picture["pictures:id_picture"]]["comments"] = $comments;

            }
            array_push($filteredEvents, $event);
        }
        return $filteredEvents;
    }
}
