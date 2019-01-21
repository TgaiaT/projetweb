<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\PostsController as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostsController extends Controller
{

	public function index()
	{
		dd(Session::all());
		$posts = Post::with('category')->get();
		return view('posts.index', compact('posts'));
	}


}
