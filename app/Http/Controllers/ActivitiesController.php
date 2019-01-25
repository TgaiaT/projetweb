<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ActivitiesRepository;
use App\Http\Requests\CreateActivityRequest;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function showActivities(Request $request)
    {
        $activities = ActivitiesRepository::getActivities();
        $creation_message = ($request->session()->get("create_activity_message")) ? $request->session()->get("create_activity_message") : null;
        $request->session()->forget("create_activity_message");
        return view('idee', [
            "activities" => $activities,
            "state" => "pending",
            "creation_message" => $creation_message
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
}
