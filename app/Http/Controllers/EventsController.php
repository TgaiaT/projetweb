<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EventsRepository;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function showEvents(Request $request)
    {
        $events = EventsRepository::getEvents();
        return view('event', [
            "events" => $events,
        ]);
    }
}
