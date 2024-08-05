<?php

namespace App\Http\Controllers;

use Illuminate\Database\UniqueConstraintViolationException;
use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
	/**
	* Display a listing of the resource.
	*/
	public function index(): View
	{
		return view('blog.index');
	}

	/**
	* Show the form for creating a new resource.
	*/
	public function create()
	{
		//
	}

	/**
	* Store a newly created resource in storage.
	*/
	public function store(Request $request): RedirectResponse 
	{
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'content' => 'required|string',
		]);

		$validated['heading'] = preg_replace('/[\p{P}]/u', '', $validated['title']);
		$validated['heading'] = str_replace(" ", "-", $validated['heading']);

		$epic_error = "";	
		try 
		{
			$request->user()->blogs()->create($validated);
		} 
		catch (UniqueConstraintViolationException $e) 
		{
			$epic_error = "Duplicate title detected! Please choose a different title."; 
		}
		return redirect(route('blog.index'))->with('errorMsg',$epic_error);
	}

	public function storeComment(Request $request, Blog $blog): View 
	{

		$validated = $request->validate([
		'message' => 'required|string|max:255',
		]);
		

		$blog = Blog::find($request->input('testStuff'));	

		$validated['blog_id'] = $blog->id;
		

		//$request->user()->comments()->create($validated);
		
		$dbData = [
			"id" => null,
			"user_id" => $request->user()->id,
			"blog_id" => $validated['blog_id'],
			"message" => $validated['message'],
			"created_at" => Carbon::now(),
			"updated_at" => Carbon::now(),
		];

		DB::table('comments')->insert($dbData);

		return view('blog.list', ['blog' => $blog, 'comments' => Comment::whereBelongsTo($blog)->get(),]);
	}

	/**
	* Display the specified resource.
	*/
	public function show(): View
	{
		return view('blog.show', [
			'blogs' => Blog::with('user')->latest()->get(),	
		]);
	}

	public function showSpecific(Blog $blog): View
	{
		return view('blog.list', ['blog' => $blog, 'comments' => Comment::whereBelongsTo($blog)->get(),]);
	}

	/**
	* Show the form for editing the specified resource.
	*/
	public function edit(Blog $blog)
	{
		//
	}

	/**
	* Update the specified resource in storage.
	*/
	public function update(Request $request, Blog $blog)
	{
		//	
	}

	public function modify(Request $request)
	{
		dd($request);
		die();	
	}

	/**
	* Remove the specified resource from storage.
	*/
	public function destroy(Blog $blog)
	{
		//
	}
}
