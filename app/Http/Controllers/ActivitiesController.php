<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ActivitiesRepository;
use App\Http\Repositories\BanRepository;
use App\Http\Repositories\EventsRepository;
use App\Http\Repositories\MailRepository;
use App\Http\Requests\CreateActivityRequest;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function showActivities(Request $request)
    {
        $activities = ActivitiesRepository::getActivities();
        $events = null;
        if (session()->get("isConnected") && session()->all()["user"]["rankLevel"] >=5)
        {
            $events = EventsRepository::getEvents();
            $events = EventsRepository::filterByDate($events, "future", null);
        }
        $creation_message = ($request->session()->get("create_activity_message")) ? $request->session()->get("create_activity_message") : null;
        $request->session()->forget("create_activity_message");
        return view('idee', [
            "activities" => $activities,
            "state" => "pending",
            "creation_message" => $creation_message,
            "events" => $events
        ]);
    }

    public function createActivity(CreateActivityRequest $request)
    {
        $request->validated();

        if (ActivitiesRepository::createActivity(
            $request->input("name"),
            $request->input("description"),
            $request->input("event"),
            $request->session()->all()["user"]["id"]
        ))
        {
            $request->session()->put("create_activity_message", "Erreur durant la création de l'activité, merci de rééssayer.");
            return redirect('idees');
        }
        else
        {
            $request->session()->put("create_activity_message", "L'activité à bien été créée !");
            return redirect('idees');
        }
    }

    public function updateActivity(Request $request)
    {
        if (isset($request->input("id_activity")[0]) && isset($request->input("id_event")[0]))
        {
            $res = ActivitiesRepository::updateActivity($request->input("id_activity"), $request->input("id_event"));
            if ($res)
            {
                return view('oops');
            }
            else
            {
                $activity = ActivitiesRepository::getActivity($request->input("id_activity"));
                MailRepository::sendMail($activity["creator_email"], "Approbation de votre activité :", "Votre activité " . $activity["name"] . " a été approuvée et ajoutée à un événement.");
                return redirect('/idees');
            }
        }
    }

    public function vote(Request $request)
    {
        if (isset($request->input("id_activity")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = ActivitiesRepository::vote($request->session()->all()["user"]["id"], $request->input("id_activity"), ($request->input("method") == "like") ? true : false);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                return redirect('/idees');
            }
        }
    }

    public function register(Request $request)
    {
        if (isset($request->input("id_activity")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = ActivitiesRepository::register($request->session()->all()["user"]["id"], $request->input("id_activity"), ($request->input("method") == "register") ? true : false);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                return redirect('/event');
            }
        }
    }

    public function ban(Request $request)
    {
        if (isset($request->input("id_activity")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = ActivitiesRepository::ban($request->input("id_activity"), ($request->input("method") == "ban") ? true : false);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                BanRepository::ban($request->session()->all()["user"]["id"], "Your activity have been banned !");
                return redirect('/idees');
            }
        }
    }
}
