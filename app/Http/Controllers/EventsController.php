<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EventsRepository;
use App\Http\Repositories\UsersRepository;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\PictureRequest;
use Illuminate\Http\Request;
use App\Http\Repositories\ActivitiesRepository;
use App\Http\Repositories\BanRepository;

class EventsController extends Controller
{
    /*
     * Show the event view.
     */
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

    /*
     * Show the event form.
     */
    public function showCreateForm(Request $request)
    {
        return view('createEvent');
    }

    /*
     * Create an event.
     */
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
                $request->input("location"),
                isset($request->input("image")[0]) ? $request->input("image") : "/images/bde.jpg"
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

    /*
     * Comment a picture.
     */
    public function comment(CommentRequest $request)
    {
        $request->validated();
        if (isset($request->input("id_picture")[0]) && isset($request->input("comment")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = EventsRepository::comment($request->session()->all()["user"]["id"], $request->input("id_picture"), $request->input("comment"), ($request->input("method") == "comment") ? true : false);
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

    /*
     *  Add a picture on an event.
     *  Store the picture in the '/images/events/' dir.
     */
    public function addPicture(PictureRequest $request)
    {
        $request->validated();
        if (isset($request->input("id_event")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $imageName = "userId=" . $request->session()->all()["user"]["id"] . "-eventId=" . $request->input("id_event") . "-time=" . time() . "." . $request->file('image')->getClientOriginalExtension();
            $url = base_path() . '/public/images/events/';
            $request->file('image')->move($url, $imageName);
            $res = EventsRepository::addPicture($request->input("id_event"), "/images/events/" . $imageName, true);
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

    /*
     * Ban an event.
     */
    public function ban(Request $request)
    {
        if (isset($request->input("id_event")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = EventsRepository::ban($request->input("id_event"), ($request->input("method") == "ban") ? true : false);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                BanRepository::ban($request->session()->all()["user"]["id"], "Your event have been banned !");
                return redirect('/event');
            }
        }
    }

    /*
     * Like a picture on a event.
     */
    public function like(Request $request)
    {
        if (isset($request->input("id_picture")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = EventsRepository::like($request->input("id_picture"), $request->session()->all()["user"]["id"],($request->input("method") == "like") ? true : false);
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

    /*
     * Get all the registered users on an event.
     * Download it in a csv file.
     */
    public function getCsv(Request $request)
    {
        $result = $request->input("activity");
        $json_data = json_decode($result, true)["registered"];
        $users = UsersRepository::getUsers();
        $final = "";

        foreach ($json_data as $id)
        {
            foreach ($users as $user)
            {
                if ($user["id"] == $id)
                {
                    $final = ($final == "") ? $user["name"] . " " . $user["lastname"] : $final . ";" . $user["name"] . " " . $user["lastname"];
                }
            }
        }
        $name = "csvAt=" . time() . ".csv";
        $url = "/var/www/yourdev/laravel/public/csv/";
        $csv = fopen($url . $name, "w");
        fwrite($csv, $final);
        fclose($csv);

        return response()->download($url . $name, "registered.csv")->deleteFileAfterSend();

    }
}
