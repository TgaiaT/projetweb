<?php

namespace App\Http\Controllers;

use App\Services;
use Illuminate\Http\Request;
use App\Http\Resources\ServicesResource;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {		
        return ServicesResource::collection(Services::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Services();
		$service->name = $request->input('name');
		$service->subname = $request->input('subname');
		$service->description = $request->input('description');
		$service->price = $request->input('price');
		$service->disponibility = $request->input('disponibility');
		$service->image = $request->input('image');
		$service->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $service)
    {
        return new ServicesResource($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Services $service)
    {
		$service->name = $request->input('name');
		$service->subname = $request->input('subname');
		$service->description = $request->input('description');
		$service->price = $request->input('price');
		$service->disponibility = $request->input('disponibility');
		$service->image = $request->input('image');
		$service->save();
		return new ServicesResource($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $service)
    {
        $service->delete();
    }
}
