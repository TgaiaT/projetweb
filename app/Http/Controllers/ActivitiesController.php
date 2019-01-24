<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ActivitiesRepository;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function showActivities(Request $request)
    {
        $activities = ActivitiesRepository::getActivities();
        return view('idee', [
           "activities" => $activities,
            "state" => "pending",
        ]);
    }

    public function showCreateForm(Request $request)
    {
        //TODO
        return view('');
    }

    public function createActivity(Request $request)
    {

    }
}
