<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EventsRepository;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function showEvents(Request $request)
    {
        $events = EventsRepository::getEvents();
        $creation_message = ($request->session()->get("create_event_message")) ? $request->session()->get("create_event_message") : null;
        $request->session()->forget("create_event_message");
        return view('event', [
            "futureEvents" => EventsRepository::filterByDate($events, "future", null),
            "pastEvents" => EventsRepository::filterByDate($events, "past", null),
            "creation_message" => $creation_message
        ]);
    }

    public function showCreateForm(Request $request)
    {
        return view('createEvent');
    }

    public function createEvent(CreateEventRequest $request)
    {
        $request->validated();
        if ($request->session()->all()["user"]["rankLevel"] >= 5)
        {
            if (EventsRepository::createEvent(
                $request->input("name"),
                $request->input("description"),
                $request->input("date"),
                $request->input("price"),
                $request->input("location")
            ))
            {
                $request->session()->put("create_event_message", "Une erreur est survenue durant la création de l'événement.");
                return redirect('event');
            }
            else
            {
                $request->session()->put("create_event_message", "L'événement à bien été créé !");
                return redirect('event');
            }
        }
        else
        {
            $request->session()->put("create_event_message", "Une erreur est survenue durant la création de l'événement.");
            return redirect('event');
        }
    }
}
