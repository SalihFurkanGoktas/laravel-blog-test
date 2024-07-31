<?php

namespace App\Http\Controllers;

use Illuminate\Database\UniqueConstraintViolationException;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
	    echo "hello world";


	    $validated = $request->validate([
		    'title' => 'required|string|max:255',
		    'content' => 'required|string|max:20000',
	    ]);

	$validated['heading'] = preg_replace('/[\p{P}]/u', '', $validated['title']);
	$validated['heading'] = str_replace(" ", "-", $validated['heading']);

	//var_dump($validated);
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
	    //var_dump($blog);
	    return view('blog.list', ['blog' => $blog]);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
