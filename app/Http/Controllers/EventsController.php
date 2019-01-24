<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EventsRepository;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function showEvents(Request $request)
    {
        $events = EventsRepository::getEvents();
        //$events = EventsRepository::filterByDate($events, "future", null);
        return view('event', [
            "futureEvents" => EventsRepository::filterByDate($events, "future", null),
            "pastEvents" => EventsRepository::filterByDate($events, "past", null),
        ]);
    }

    public function showCreateForm()
    {

    }

    public function createEvent()
    {

    }
}
